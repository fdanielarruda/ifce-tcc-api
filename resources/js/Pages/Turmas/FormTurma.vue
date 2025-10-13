<script setup lang="ts">

interface TurmaForm {
    titulo: string;
    ano: number;
    errors: {
        titulo?: string;
        ano?: string;
    };
    processing: boolean;
}

const props = defineProps<{
    form: TurmaForm;
    isEdit?: boolean;
}>();
</script>

<template>
    <div class="space-y-6">
        <div>
            <label for="titulo" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Título da
                Turma</label>
            <input id="titulo" type="text"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-gray-900 dark:text-white"
                v-model="form.titulo" required autofocus />
            <div v-if="form.errors.titulo" class="text-sm text-red-600 dark:text-red-400 mt-2">{{ form.errors.titulo }}
            </div>
        </div>

        <div>
            <label for="ano" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ano</label>
            <input id="ano" type="number"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-gray-900 dark:text-white"
                v-model.number="form.ano" required min="1900" :max="new Date().getFullYear() + 1" />
            <div v-if="form.errors.ano" class="text-sm text-red-600 dark:text-red-400 mt-2">{{ form.errors.ano }}</div>
        </div>
    </div>
</template>