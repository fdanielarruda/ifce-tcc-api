<script setup lang="ts">

interface DisciplinaForm {
    nome: string;
    sigla: string;
    errors: {
        nome?: string;
        sigla?: string;
    };
    processing: boolean;
}

const props = defineProps<{
    form: DisciplinaForm;
    isEdit?: boolean;
}>();
</script>

<template>
    <div class="space-y-6">
        <div>
            <label for="nome" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nome da
                Disciplina</label>
            <input id="nome" type="text"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-gray-900 dark:text-white"
                v-model="form.nome" required autofocus />
            <div v-if="form.errors.nome" class="text-sm text-red-600 dark:text-red-400 mt-2">{{ form.errors.nome }}
            </div>
        </div>

        <div>
            <label for="sigla" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Sigla</label>
            <input id="sigla" type="text"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-gray-900 dark:text-white"
                v-model="form.sigla" required autofocus maxlength="10" />
            <div v-if="form.errors.sigla" class="text-sm text-red-600 dark:text-red-400 mt-2">{{ form.errors.sigla }}
            </div>
        </div>
    </div>
</template>