<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import IconButton from '@/Components/Itens/IconButton.vue';
import { TrashIcon, PencilSquareIcon } from '@heroicons/vue/24/outline';
import ConfirmDeletionModal from '@/Components/ConfirmDeletionModal.vue';
import TextButton from '@/Components/Itens/TextButton.vue';
import { Disciplina } from '@/types/inertia';

const props = defineProps<{
    disciplinas: Disciplina[];
}>();

const itemToDelete = ref<Disciplina | null>(null);
const confirmingDeletion = ref(false);

const openConfirmDeleteModal = (disciplina: Disciplina) => {
    itemToDelete.value = disciplina;
    confirmingDeletion.value = true;
};

const closeModal = () => {
    confirmingDeletion.value = false;
    itemToDelete.value = null;
};

const deleteItem = () => {
    if (!itemToDelete.value) return;
    router.delete(route('disciplinas.destroy', itemToDelete.value.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <div>

        <Head title="Disciplinas" />

        <AuthenticatedLayout>

            <div class="flex justify-end items-center mb-6">
                <TextButton :href="route('disciplinas.create')">
                    Nova disciplina
                </TextButton>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div v-if="disciplinas.length > 0" class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Disciplina</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-400">
                                    Sigla</th>
                                <th class="relative px-6 py-3"><span class="sr-only">Ações</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="disciplina in disciplinas" :key="disciplina.id"
                                class="hover:bg-gray-50 dark:hover:bg-gray-700/50">

                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                    {{ disciplina.nome }}</td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 dark:text-white">
                                    {{ disciplina.sigla }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-1">
                                        <IconButton :href="route('disciplinas.edit', disciplina.id)" color="yellow"
                                            title="Editar">
                                            <PencilSquareIcon class="h-5 w-5" />
                                        </IconButton>
                                        <IconButton as="button" color="red" title="Excluir"
                                            @click="openConfirmDeleteModal(disciplina)">
                                            <TrashIcon class="h-5 w-5" />
                                        </IconButton>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-else class="p-6 text-center text-gray-500">
                    <p>Nenhuma disciplina encontrada. Crie a primeira!</p>
                </div>
            </div>
        </AuthenticatedLayout>

        <ConfirmDeletionModal :show="confirmingDeletion" title="Excluir Disciplina"
            :message="`Tem certeza que deseja mover a disciplina '${itemToDelete?.nome} para a lixeira?`"
            buttonText="Excluir" @close="closeModal" @confirm="deleteItem" />
    </div>
</template>