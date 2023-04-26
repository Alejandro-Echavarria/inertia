<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Input from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

export default {
    components: {
        AppLayout,
        Input,
        InputError
    },

    data() {
        return {
            contact: {
                first_name: '',
                last_name: '',
                organization_id: '',
                country_id: '',
                email: '',
                phone: '',
                address: '',
                city: '',
                state: '',
                zip_code: '',
            },
        }
    },

    methods: {
        store() {
            this.$inertia.post(this.route('contacts.store'), this.contact);
        },
    },

    props: {
        organizations: {
            type: Object,
            required: true,
        },
        countries: {
            type: Object,
            required: true,
        }
    }
}
</script>

<template>
    <AppLayout title="Contacts create">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                <span class="text-gray-400">Contacts</span> / Create
            </h1>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-4 px-4 sm:px-0">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-3">Create contact form</h2>

                    <div class="bg-white px-6 py-8 rounded-lg border-2">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label>
                                    First Name
                                    <Input v-model="contact.first_name" type="text" class="w-full" id="first_name" name="first_name" />
                                    <InputError :message="$page.props.errors.first_name" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Last Name
                                    <Input v-model="contact.last_name" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.last_name" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Email
                                    <Input v-model="contact.email" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.email" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Phone
                                    <Input v-model="contact.phone" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.phone" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Organization
                                    <!-- <Input v-model="contact.organization_id" type="text" class="w-full"></Input> -->
                                    <select v-model="contact.organization_id" class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-blue-500 focus:border-blue-500 peer transition cursor-pointer">
                                        <option  value="" disabled selected> Select one organization</option>
                                        <option v-for="organization in organizations" :value="organization.id" :key="'organization-' + organization.id">
                                            {{ organization.name }}
                                        </option>
                                    </select>
                                    <InputError :message="$page.props.errors.organization_id" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Country
                                    <select v-model="contact.country_id" class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-blue-500 focus:border-blue-500 peer transition cursor-pointer">
                                        <option value="" disabled selected> Select one country</option>
                                        <option v-for="country in countries" :value="country.id" :key="'country-' + country.id">
                                            {{ country.name }}
                                        </option>
                                    </select>
                                    <InputError :message="$page.props.errors.country_id" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    City
                                    <Input v-model="contact.city" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.city" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    State
                                    <Input v-model="contact.state" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.state" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Address
                                    <Input v-model="contact.address" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.address" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Zipe Code
                                    <Input v-model="contact.zip_code" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.zip_code" />
                                </label>
                            </div>
                        </div>
                        <div class="flex justify-end pt-3">
                            <button 
                                @click.prevent="store"
                                class="font-semibold text-blue-600 dark:text-blue-500 hover:underline">
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>