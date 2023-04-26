<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import pickBy from 'lodash/pickBy';
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Pagination,
        Link
    },

    data() {
        return {
            search: this.filter.search,
        }
    },

    computed: {
        debounceData() {
            return this.debounce(this.contactsFilter, 500);
        },
    },

    mounted() {
        // crear una versión debounced de la función getBooks con un tiempo de espera de 500ms
        this.debounceData = this.debounce(this.contactsFilter, 500);
    },

    watch: {
        search() {
            this.debounceData();
        }
    },

    methods: {
        contactsFilter() {
            this.$inertia.get('/contacts', pickBy({ search: this.search, page: this.page }), { preserveState: true });
        },

        debounce(func, wait) {
            let timeout;
            return function () {
                const context = this,
                    args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    timeout = null;
                    func.apply(context, args);
                }, wait);
            };
        }
    },

    props: {
        contacts: {
            type: Object,
            required: true,
        },
        filter: {
            type: Object,
        }
    }
}
</script>

<template>
    <AppLayout title="Contacts">
        <template #header>
            <h2 id="con" class="font-semibold text-xl text-gray-800 leading-tight">
                Contacts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-4 px-4 sm:px-0">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="flex items-center">
                            <input v-model="search" type="text" id="table-search"
                                class="flex-1 lock p-2 pl-10 py-2.5 px-0 text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-blue-500 focus:border-blue-500 peer transition"
                                placeholder="Search for items">
                            <Link :href="route('contacts.create')" class="ml-4 flex-shrink-0 font-semibold text-blue-600 dark:text-blue-500 hover:underline">New</Link>
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto md:border-2 sm:rounded-lg">
                    <table id="table-01" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Oranization
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    City
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="contact in contacts.data" :key="contact.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ contact.first_name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ contact.organization.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ contact.city }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ contact.phone }}
                                </td>
                                <td class="px-6 py-4">
                                    <Link :href="route('contacts.edit', contact.id)"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :pagination="contacts" />
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>