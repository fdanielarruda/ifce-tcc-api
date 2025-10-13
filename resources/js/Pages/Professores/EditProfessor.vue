<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackButtonRow from '@/Components/BackButtonRow.vue';
import FormProfessor from './FormProfessor.vue';
import { Professor } from '@/types/inertia';

const props = defineProps<{
    professor: Professor;
}>();

const form = useForm({
    nome: props.professor.nome,
    email: props.professor.email,
});

const submit = () => {
    form.put(route('professores.update', props.professor.id));
};
</script>

<template>

    <Head :title="`Editar Professor: ${props.professor.nome}`" />

    <AuthenticatedLayout>
        <BackButtonRow :href="route('professores.index')" />

        <form @submit.prevent="submit" class="mt-6">
            <FormProfessor :form="form" :is-edit="true" />

            <div class="flex items-center justify-end mt-6">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Atualizar Professor
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>