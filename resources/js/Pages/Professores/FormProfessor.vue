<script setup lang="ts">

interface ProfessorForm {
    nome: string;
    email: string;
    errors: {
        nome?: string;
        email?: string;
    };
    processing: boolean;
}

const props = defineProps<{
    form: ProfessorForm;
    isEdit?: boolean;
}>();
</script>

<template>
    <div class="space-y-6">
        <div>
            <label for="nome" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nome do
                Professor</label>
            <input id="nome" type="text"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-gray-900 dark:text-white"
                v-model="form.nome" required autofocus />
            <div v-if="form.errors.nome" class="text-sm text-red-600 dark:text-red-400 mt-2">{{ form.errors.nome }}
            </div>
        </div>

        <div>
            <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
            <input id="email" type="email"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-gray-900 dark:text-white"
                v-model="form.email" required />
            <div v-if="form.errors.email" class="text-sm text-red-600 dark:text-red-400 mt-2">{{ form.errors.email }}
            </div>
        </div>
    </div>
</template>