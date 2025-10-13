<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackButtonRow from '@/Components/BackButtonRow.vue';
import FormTurma from './FormProfessor.vue';

const form = useForm({
    nome: '',
    email: ''
});

const submit = () => {
    form.post(route('professores.store'));
};
</script>

<template>

    <Head title="Novo Professor" />

    <AuthenticatedLayout>
        <BackButtonRow :href="route('professores.index')" />
        
        <form @submit.prevent="submit" class="mt-6">
            <FormTurma :form="form" />

            <div class="flex items-center justify-end mt-6">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Salvar Professor
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>