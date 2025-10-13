import { PageProps as InertiaPageProps } from '@inertiajs/core';
import { Errors, Page, PageProps } from '@inertiajs/vue3';

interface Turma {
    id: number;
    titulo: string;
    ano: number;
}

interface Professor {
    id: number;
    nome: string;
    email: string;
}

interface Disciplina {
    id: number;
    nome: string;
    sigla: string;
}

interface Horario {
    id: number;
    titulo: string;
}

interface FlashMessages {
    success?: string;
    error?: string;
    message?: string;
}

interface CustomPageProps extends PageProps {
    flash: FlashMessages;
}

declare module '@inertiajs/vue3' {
    export interface PageProps extends CustomPageProps { }
}

declare module '@inertiajs/core' {
    export interface PageProps extends CustomPageProps { }
}

declare global {
    var route: typeof ZiggyRoute;
}