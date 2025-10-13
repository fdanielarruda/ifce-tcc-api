<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackButtonRow from '@/Components/BackButtonRow.vue';
import FormDisciplina from './FormDisciplina.vue';
import { Disciplina } from '@/types/inertia';

const props = defineProps<{
    disciplina: Disciplina;
}>();

const form = useForm({
    nome: props.disciplina.nome,
    sigla: props.disciplina.sigla
});

const submit = () => {
    form.put(route('disciplinas.update', props.disciplina.id));
};
</script>

<template>

    <Head :title="`Editar Disciplina: ${props.disciplina.nome}`" />

    <AuthenticatedLayout>
        <BackButtonRow :href="route('disciplinas.index')" />

        <form @submit.prevent="submit" class="mt-6">
            <FormDisciplina :form="form" :is-edit="true" />

            <div class="flex items-center justify-end mt-6">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Atualizar Disciplina
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>