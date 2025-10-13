<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackButtonRow from '@/Components/BackButtonRow.vue';
import FormTurma from './FormDisciplina.vue';

const form = useForm({
    nome: '',
    sigla: ''
});

const submit = () => {
    form.post(route('disciplinas.store'));
};
</script>

<template>

    <Head title="Nova Disciplina" />

    <AuthenticatedLayout>
        <BackButtonRow :href="route('disciplinas.index')" />
        
        <form @submit.prevent="submit" class="mt-6">
            <FormTurma :form="form" />

            <div class="flex items-center justify-end mt-6">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Salvar Disciplina
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>