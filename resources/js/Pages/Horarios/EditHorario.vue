<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackButtonRow from '@/Components/BackButtonRow.vue';
import FormHorario from './FormHorario.vue';

interface Horario {
    id: number;
    titulo: string;
    slots: Array<{
        ordem: number;
        hora_inicio: string;
        hora_fim: string;
    }>;
}

const props = defineProps<{
    horario: Horario;
}>();

const form = useForm({
    titulo: props.horario.titulo,
    slots: props.horario.slots.map(slot => ({ ...slot })),
});

const submit = () => {
    form.put(route('horarios.update', props.horario.id));
};
</script>

<template>

    <Head title="Editar Horário" />

    <AuthenticatedLayout>
        <BackButtonRow :href="route('horarios.index')" />

        <form @submit.prevent="submit">
            <FormHorario :form="form" />

            <div class="flex items-center justify-end mt-6">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Salvar
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>