<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import BackButtonRow from '@/Components/BackButtonRow.vue';
import FormHorario from './FormHorario.vue';

interface Slot {
    ordem: number;
    hora_inicio: string;
    hora_fim: string;
    [key: string]: any;
}

const form = useForm({
    titulo: '',
    slots: [] as Slot[],
});

const submit = () => {
    form.post(route('horarios.store'));
};
</script>

<template>

    <Head title="Novo Horário" />

    <AuthenticatedLayout>
        <BackButtonRow :href="route('horarios.index')" />

        <form @submit.prevent="submit">
            <FormHorario :form="form" />

            <div class="flex items-center justify-end mt-6 pt-6 dark:border-gray-700">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Salvar Horário
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>