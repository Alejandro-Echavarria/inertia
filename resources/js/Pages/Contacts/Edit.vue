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
            form: this.contact
        }
    },

    methods: {
        update() {
            this.$inertia.put(this.route('contacts.update', this.contact), this.form);
        },

        destroy() {
            this.$inertia.delete(this.route('contacts.destroy', this.contact));
        }
    },

    props: {
        contact: {
            type: Object,
            required: true,
        },
        organizations: {
            type: Object,
            required: true,
        },
        countries: {
            type: Object,
            required: true,
        }
    }

};
</script>

<template>
    <AppLayout title="Edit contacts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <span class="text-gray-400">Contacts</span> / Editing - {{ contact.first_name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="pb-4 px-4 sm:px-0">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-3">Edit contact form</h2>

                    <div class="bg-white px-6 py-8 rounded-lg border-2">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label>
                                    First Name
                                    <Input v-model="form.first_name" type="text" class="w-full" id="first_name"
                                        name="first_name" />
                                    <InputError :message="$page.props.errors.first_name" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Last Name
                                    <Input v-model="form.last_name" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.last_name" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Email
                                    <Input v-model="form.email" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.email" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Phone
                                    <Input v-model="form.phone" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.phone" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Organization
                                    <!-- <Input v-model="contact.organization_id" type="text" class="w-full"></Input> -->
                                    <select v-model="form.organization_id"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-blue-500 focus:border-blue-500 peer transition cursor-pointer">
                                        <option value="" disabled selected> Select one organization</option>
                                        <option v-for="organization in organizations" :value="organization.id"
                                            :key="'organization-' + organization.id">
                                            {{ organization.name }}
                                        </option>
                                    </select>
                                    <InputError :message="$page.props.errors.organization_id" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Country
                                    <select v-model="form.country_id"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-700 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:ring-blue-500 focus:border-blue-500 peer transition cursor-pointer">
                                        <option value="" disabled selected> Select one country</option>
                                        <option v-for="country in countries" :value="country.id"
                                            :key="'country-' + country.id">
                                            {{ country.name }}
                                        </option>
                                    </select>
                                    <InputError :message="$page.props.errors.country_id" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    City
                                    <Input v-model="form.city" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.city" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    State
                                    <Input v-model="form.state" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.state" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Address
                                    <Input v-model="form.address" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.address" />
                                </label>
                            </div>

                            <div>
                                <label>
                                    Zipe Code
                                    <Input v-model="form.zip_code" type="text" class="w-full"></Input>
                                    <InputError :message="$page.props.errors.zip_code" />
                                </label>
                            </div>
                        </div>
                        <div class="flex justify-end mt-3 space-x-5">
                            <button @click.prevent="destroy"
                                class="font-semibold text-red-600 dark:text-red-500 hover:underline">
                                Delete
                            </button>

                            <button @click.prevent="update"
                                class="font-semibold text-blue-600 dark:text-blue-500 hover:underline">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped></style>