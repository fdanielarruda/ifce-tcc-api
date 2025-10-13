<script setup lang="ts">
import { computed } from 'vue';
import { InertiaForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

interface Slot {
    ordem: number;
    hora_inicio: string;
    hora_fim: string;
}

interface HorarioData {
    titulo: string;
    slots: Slot[];
    [key: string]: any;
}

interface HorarioForm extends Omit<InertiaForm<HorarioData>, 'errors'> {
    errors: Record<string, string>;
}

const props = defineProps<{
    form: HorarioForm
}>();

const adicionarSlot = () => {
    const novaOrdem = props.form.slots.length > 0
        ? Math.max(...props.form.slots.map((s: Slot) => s.ordem)) + 1
        : 1;

    props.form.slots.push({
        ordem: novaOrdem,
        hora_inicio: '',
        hora_fim: '',
    });
};

const removerSlot = (index: number) => {
    props.form.slots.splice(index, 1);
};

const slotsOrdenados = computed(() => {
    return [...props.form.slots].sort((a, b) => a.ordem - b.ordem);
});
</script>

<template>
    <div class="space-y-6">
        <div>
            <InputLabel for="titulo" value="Título do Horário" />
            <TextInput id="titulo" v-model="form.titulo" type="text" class="mt-1 block w-full"
                placeholder="Ex: Horário 2024" required />
            <InputError :message="form.errors.titulo" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-4">
                <InputLabel value="Horários das Aulas" />
                <PrimaryButton type="button" @click="adicionarSlot">
                    + Adicionar Horário
                </PrimaryButton>
            </div>

            <div v-if="form.slots.length === 0"
                class="text-gray-500 text-center py-8 border-2 border-dashed border-gray-300 rounded-lg dark:text-gray-400 dark:border-gray-600">
                Nenhum horário adicionado. Clique em "Adicionar Horário" para começar.
            </div>

            <div v-else class="space-y-4">
                <div v-for="(slot, index) in slotsOrdenados" :key="index"
                    class="p-4 border border-gray-300 rounded-lg bg-gray-50 dark:border-gray-700 dark:bg-gray-800">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <InputLabel :for="`ordem-${index}`" value="Ordem" />
                            <TextInput :id="`ordem-${index}`" v-model.number="slot.ordem" type="number" min="1"
                                class="mt-1 block w-full" required />
                            <InputError :message="form.errors[`slots.${index}.ordem`]" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel :for="`inicio-${index}`" value="Hora Início" />
                            <TextInput :id="`inicio-${index}`" v-model="slot.hora_inicio" type="time"
                                class="mt-1 block w-full" required />
                            <InputError :message="form.errors[`slots.${index}.hora_inicio`]" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel :for="`fim-${index}`" value="Hora Fim" />
                            <TextInput :id="`fim-${index}`" v-model="slot.hora_fim" type="time"
                                class="mt-1 block w-full" required />
                            <InputError :message="form.errors[`slots.${index}.hora_fim`]" class="mt-2" />
                        </div>

                        <div class="flex items-end">
                            <DangerButton type="button" @click="removerSlot(index)" class="w-full">
                                Remover
                            </DangerButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>