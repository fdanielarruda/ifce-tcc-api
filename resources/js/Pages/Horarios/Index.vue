<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import TextButton from '@/Components/Itens/TextButton.vue';

interface Slot {
    id: number;
    ordem: number;
    hora_inicio: string;
    hora_fim: string;
}

interface Horario {
    id: number;
    titulo: string;
    slots: Slot[];
}

defineProps<{
    horarios: Horario[];
}>();

const deleteHorario = (id: number) => {
    if (confirm('Tem certeza que deseja excluir este horário?')) {
        router.delete(route('horarios.destroy', id));
    }
};
</script>

<template>

    <Head title="Horários" />

    <AuthenticatedLayout>
        <div class="flex justify-end items-center mb-6">
            <TextButton :href="route('horarios.create')">
                Novo Horário
            </TextButton>
        </div>

        <div v-if="horarios.length === 0" class="text-center py-12 text-gray-500 dark:text-gray-400">
            Nenhum horário cadastrado. Clique em "Novo Horário" para começar.
        </div>

        <div v-else class="space-y-6">
            <div v-for="horario in horarios" :key="horario.id"
                class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition dark:border-gray-700 dark:bg-gray-800">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ horario.titulo }}</h3>
                    <div class="flex gap-2">
                        <Link :href="route('horarios.edit', horario.id)">
                        <PrimaryButton>Editar</PrimaryButton>
                        </Link>
                        <DangerButton @click="deleteHorario(horario.id)">
                            Excluir
                        </DangerButton>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-300">
                                    Ordem</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-300">
                                    Início</th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-gray-300">
                                    Fim</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="slot in horario.slots" :key="slot.id">
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-200">{{ slot.ordem }}º</td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-200">{{ slot.hora_inicio }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 dark:text-gray-200">{{ slot.hora_fim }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>