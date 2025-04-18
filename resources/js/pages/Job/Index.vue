<script setup>
import { ref, onMounted } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Button from "primevue/button";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';                   // optional

const breadcrumbs = [
    {
        title: 'All Jobs',
        href: '/job-post',
    },
];

const customersData = [
    {
        id: 1,
        name: 'John Doe',
        country: { name: 'USA' },
        company: 'TechCorp',
        representative: { name: 'Jane Smith' }
    },
    {
        id: 2,
        name: 'Anna Johnson',
        country: { name: 'Canada' },
        company: 'InnoSolutions',
        representative: { name: 'David Brown' }
    },
    {
        id: 3,
        name: 'Peter Parker',
        country: { name: 'United Kingdom' },
        company: 'WebDynamics',
        representative: { name: 'Steve Rogers' }
    },
    {
        id: 4,
        name: 'Mary Jane',
        country: { name: 'Australia' },
        company: 'Oceanic Tech',
        representative: { name: 'Bruce Wayne' }
    },
    {
        id: 5,
        name: 'Tony Stark',
        country: { name: 'USA' },
        company: 'Stark Industries',
        representative: { name: 'Pepper Potts' }
    },
    {
        id: 5,
        name: 'Tony Stark',
        country: { name: 'USA' },
        company: 'Stark Industries',
        representative: { name: 'Pepper Potts' }
    }
];

onMounted(() => {
    customers.value = customersData;
});

const customers = ref();

</script>

<template>
    <Head title="Job Post" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto">
            <div class="mt-2 flex justify-between">
                <h1 class="mt-2 text-lg font-bold">All Job Posts</h1>
                <Link :href="route('job.post.create')">
                    <Button icon="pi pi-user-plus" label="Add New Job Post" severity="info" />
                </Link>
            </div>
            <div class="card mt-2 flex flex-start">
                <div class="card w-full">
                    <DataTable :value="customers" showGridlines stripedRows paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]" tableStyle="min-width: 50rem">
                        <Column field="name" header="Name" style="width: 25%"></Column>
                        <Column field="country.name" header="Country" style="width: 25%"></Column>
                        <Column field="company" header="Company" style="width: 25%"></Column>
                        <Column field="representative.name" header="Representative" style="width: 25%"></Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
