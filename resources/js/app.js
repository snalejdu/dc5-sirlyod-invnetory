import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from 'ziggy-js'
import { route } from 'ziggy-js'  // 👈 add this


window.route = route

createInertiaApp({
    title: (title) => `${title} - Inventory App`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const ziggyConfig = props.initialPage.props.ziggy

        // Update Ziggy's route config on every page
        window.route = (name, params, absolute) => route(name, params, absolute, ziggyConfig)

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, ziggyConfig)
            .mount(el)
    },
    progress: {
        color: '#0d6efd',
    },
})
