<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import IconButton from '@/Components/Itens/IconButton.vue';
import { TrashIcon, PencilSquareIcon } from '@heroicons/vue/24/outline';
import ConfirmDeletionModal from '@/Components/ConfirmDeletionModal.vue';
import TextButton from '@/Components/Itens/TextButton.vue';
import { Turma } from '@/types/inertia';

const props = defineProps<{
    turmas: Turma[];
}>();

const itemToDelete = ref<Turma | null>(null);
const confirmingDeletion = ref(false);

const openConfirmDeleteModal = (turma: Turma) => {
    itemToDelete.value = turma;
    confirmingDeletion.value = true;
};

const closeModal = () => {
    confirmingDeletion.value = false;
    itemToDelete.value = null;
};

const deleteItem = () => {
    if (!itemToDelete.value) return;
    router.delete(route('turmas.destroy', itemToDelete.value.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <div>

        <Head title="Turmas" />

        <AuthenticatedLayout>

            <div class="flex justify-end items-center mb-6">
                <TextButton :href="route('turmas.create')">
                    Nova Turma
                </TextButton>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div v-if="turmas.length > 0" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Título</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Ano</th>
                                <th class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="turma in turmas" :key="turma.id"
                                class="hover:bg-gray-50 dark:hover:bg-gray-700/50">

                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                    {{ turma.titulo }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ turma.ano }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-1">
                                        <IconButton :href="route('turmas.edit', turma.id)" color="yellow"
                                            title="Editar">
                                            <PencilSquareIcon class="h-5 w-5" />
                                        </IconButton>
                                        <IconButton as="button" color="red" title="Excluir"
                                            @click="openConfirmDeleteModal(turma)">
                                            <TrashIcon class="h-5 w-5" />
                                        </IconButton>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-else class="p-6 text-center text-gray-500">
                    <p>Nenhuma turma encontrada. Crie a primeira!</p>
                </div>
            </div>
        </AuthenticatedLayout>

        <ConfirmDeletionModal :show="confirmingDeletion" title="Excluir Turma"
            :message="`Tem certeza que deseja mover a turma '${itemToDelete?.titulo} - ${itemToDelete?.ano}' para a lixeira?`"
            buttonText="Excluir" @close="closeModal" @confirm="deleteItem" />
    </div>
</template>