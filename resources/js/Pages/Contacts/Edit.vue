<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    contact: {
        type: Object,
        required: true,
    }
});
</script>

<template>
    <AppLayout title="Contacts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Contact - {{ contact.first_name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{ contact }}
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
    
</style>