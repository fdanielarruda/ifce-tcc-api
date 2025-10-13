<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackButtonRow from '@/Components/BackButtonRow.vue';
import FormTurma from './FormTurma.vue';
import { Turma } from '@/types/inertia';

const props = defineProps<{
    turma: Turma;
}>();

const form = useForm({
    titulo: props.turma.titulo,
    ano: props.turma.ano,
});

const submit = () => {
    console.log('Sending PUT to:', route('turmas.update', props.turma.id));
    console.log('ID:', props.turma.id);

    form.put(route('turmas.update', props.turma.id));
};
</script>

<template>

    <Head :title="`Editar Turma: ${props.turma.titulo}`" />

    <AuthenticatedLayout>
        <BackButtonRow :href="route('turmas.index')" />

        <form @submit.prevent="submit" class="mt-6">
            <FormTurma :form="form" :is-edit="true" />

            <div class="flex items-center justify-end mt-6">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Atualizar Turma
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>