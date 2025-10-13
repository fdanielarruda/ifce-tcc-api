import {
    HomeIcon,
    ArrowLeftEndOnRectangleIcon,
    CalendarDateRangeIcon
} from '@heroicons/vue/24/outline';

interface NavigationLink {
    label?: string;
    icon?: any;
    route?: string;
    condition?: boolean | ((isRoot: boolean) => boolean);
    method?: string;
    as?: string;
    textClass?: string;
    iconClass?: string;
    type?: 'link' | 'separator';
    children?: NavigationLink[];
}

export const staticNavigationLinks: NavigationLink[] = [
    {
        label: 'Dashboard',
        icon: HomeIcon,
        route: 'dashboard',
        type: 'link',
    },
    {
        label: 'Turmas',
        icon: CalendarDateRangeIcon,
        route: 'turmas.index',
        type: 'link',
    },
    {
        label: 'Professores',
        icon: CalendarDateRangeIcon,
        route: 'professores.index',
        type: 'link',
    },
    {
        label: 'Disciplinas',
        icon: CalendarDateRangeIcon,
        route: 'disciplinas.index',
        type: 'link',
    },
    {
        label: 'Horários',
        icon: CalendarDateRangeIcon,
        route: 'horarios.index',
        type: 'link',
    },
];