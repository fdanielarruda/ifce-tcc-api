<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="p-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">
                Bem-vindo(a)!
            </h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Este é o seu painel de controle. A partir daqui, você pode gerenciar as grades horárias.
            </p>
        </div>
    </AuthenticatedLayout>
</template>