<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackButtonRow from '@/Components/BackButtonRow.vue';
import FormTurma from './FormTurma.vue';

const form = useForm({
    titulo: '',
    ano: new Date().getFullYear(),
});

const submit = () => {
    form.post(route('turmas.store'));
};
</script>

<template>

    <Head title="Nova Turma" />

    <AuthenticatedLayout>
        <BackButtonRow :href="route('turmas.index')" />
        
        <form @submit.prevent="submit" class="mt-6">
            <FormTurma :form="form" />

            <div class="flex items-center justify-end mt-6">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Salvar Turma
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>