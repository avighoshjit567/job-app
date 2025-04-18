<script setup>
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Form } from '@primevue/forms';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Select from 'primevue/select';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';
import Message from 'primevue/message';
import Button from "primevue/button";
import Card from 'primevue/card';
import Editor from 'primevue/editor';
import FileUpload from 'primevue/fileupload';
import { Inertia } from '@inertiajs/inertia';


const toast = useToast();
const value = ref('');

const initialValues = ref({
    title: '',
    location: '',
    experience: '',
    salary: '',
    job_type: '',
    vacancy: '',
    gender: '',
    job_description: '',
});

const breadcrumbs = [
    {
        title: 'Create Job Post',
        href: '/job-post',
    },
];

const resolver = ({ values }) => {
    const errors = {};  
    console.log(values);

    if (!values.title) {
        errors.title = [{ message: 'Post Title is required.' }];
    }
    if (!values.location) {
        errors.location = [{ message: 'Location is required.' }];
    }
    if (!values.experience) {
        errors.experience = [{ message: 'Experience is required.' }];
    }
    if (!values.salary) {
        errors.salary = [{ message: 'Salary is required.' }];
    }
    if (!values.job_type) {
        errors.job_type = [{ message: 'Job Type is required.' }];
    }
    if (!values.vacancy) {
        errors.vacancy = [{ message: 'Vacancy is required.' }];
    }
    if (!values.gender) {
        errors.gender = [{ message: 'Gender is required.' }];
    }
    if (!values.job_description || values.job_description.trim() === '') {
        errors.job_description = [{ message: 'Job Description is required.' }];
    }

    return {
        values,
        errors
    };
};

const job_type = ref([
    { name: 'Select One', code: '' },
    { name: 'Full Time', code: 'Full Time' },
    { name: 'Part Time', code: 'Part Time' },
]);

const gender_options = ref([
    { name: 'Male', code: 'Male' },
    { name: 'Female', code: 'Female' },
    { name: 'Both', code: 'Both' },
]);

const onFormSubmit = () => {
    const formData = new FormData()

    // Append form fields to FormData
    formData.append('title', initialValues.value.title)
    formData.append('location', initialValues.value.location)
    formData.append('experience', initialValues.value.experience)
    formData.append('salary', initialValues.value.salary)
    formData.append('job_type', initialValues.value.job_type)
    formData.append('vacancy', initialValues.value.vacancy)
    formData.append('gender', initialValues.value.gender)
    formData.append('job_description', value.value)

    // Append file (if any)
    // const fileInput = document.querySelector('input[type="file"]')
    // if (fileInput.files.length > 0) {
    //     formData.append('banner', fileInput.files[0])
    // }

    // Send the form data using Inertia.post
    Inertia.post('/job-post/save', formData, {
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Job post created successfully.',
                life: 3000,
            })
        },
        onError: (errors) => {
            toast.add({
                severity: 'error',
                summary: 'Failed to create job post.',
                detail: errors,
                life: 3000,
            })
        },
    })
};

const onUpload = () =>{

};
</script>

<template>

    <Head title="Create Job Post" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="container mx-auto">
            <Toast />
            <div class="mt-2 flex justify-between">
                <h1 class="mt-2 text-lg font-bold">Create Job Posts</h1>
                <Link :href="route('job.post')">
                <Button icon="pi pi-users" label="All Job Posts" severity="info" />
                </Link>
            </div>
            <Card>
                <template #title>Create Job Posts Form</template>
                <template #content>
                    <Form v-slot="$form" :initialValues="initialValues" :resolver="resolver" :validateOnBlur="true" @submit="onFormSubmit" method="post" action="/job-post/save" class="flex flex-col w-full">
                        <!-- Add CSRF Token -->
                        <input type="hidden" name="_token" value="" />
                        <!-- Banner -->
                        <div class="field">
                            <label for="title" class="block text-sm font-medium text-gray-700">Banner</label>
                            <FileUpload ref="fileupload" mode="basic" name="demo[]" url="/api/upload" accept="image/*" :maxFileSize="1000000" @upload="onUpload" />
                            
                        </div>
                        
                        <!-- Job Title -->
                        <div class="field">
                            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                            <InputText id="title" name="title" placeholder="Enter Job Title" class="mt-1 w-full" />
                            <Message v-if="$form.title?.invalid" severity="error" size="small" variant="simple">{{ $form.title.error?.message }}
                            </Message>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <!-- Location -->
                            <div class="mt-3 field">
                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                <InputText id="location" name="location" placeholder="Enter Location" class="mt-1 w-full" />
                                <Message v-if="$form.location?.invalid" severity="error" size="small" variant="simple">{{ $form.location.error?.message }}
                                </Message>
                            </div>
                            
                            <!-- Experience -->
                            <div class="mt-3 field">
                                <label for="experience" class="block text-sm font-medium text-gray-700">Experience</label>
                                <InputText id="experience" name="experience" placeholder="Enter Experience" class="mt-1 w-full" />
                                <Message v-if="$form.experience?.invalid" severity="error" size="small" variant="simple">{{ $form.experience.error?.message }}
                                </Message>
                            </div>
                            
                            <!-- Salary -->
                            <div class="mt-3 field">
                                <label for="salary" class="block text-sm font-medium text-gray-700">Salary</label>
                                <InputText id="salary" name="salary" placeholder="Enter Salary" class="mt-1 w-full" />
                                <Message v-if="$form.salary?.invalid" severity="error" size="small" variant="simple">{{ $form.salary.error?.message }}
                                </Message>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <!-- Job Type -->
                            <div class="mt-3 field">
                                <label for="job_type" class="block text-sm font-medium text-gray-700">Job Type</label>
                                <Select :options="job_type" name="job_type" optionLabel="name" placeholder="Select a Job Type" class="w-full" />
                                <Message v-if="$form.job_type?.invalid" severity="error" size="small" variant="simple">{{ $form.job_type.error?.message }}
                                </Message>
                            </div>
                            
                            <!-- Vacancy -->
                            <div class="mt-3 field">
                                <label for="vacancy" class="block text-sm font-medium text-gray-700">Vacancy</label>
                                <InputText id="vacancy" name="vacancy" placeholder="Enter Vacancy" class="mt-1 w-full" />
                                <Message v-if="$form.vacancy?.invalid" severity="error" size="small" variant="simple">{{ $form.vacancy.error?.message }}
                                </Message>
                            </div>
                            
                            <!-- Gender -->
                            <div class="mt-3 field">
                                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                <Select :options="gender_options" name="gender" optionLabel="name" placeholder="Select a Gender" class="w-full" />
                                <Message v-if="$form.gender?.invalid" severity="error" size="small" variant="simple">{{ $form.gender.error?.message }}
                                </Message>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-2 mb-4 field">
                            <label for="title" class="block text-sm font-medium text-gray-700">Job Description</label>
                            <Editor v-model="value" editorStyle="height: 320px" class="mt-2"/>
                            <Message v-if="$form.job_description?.invalid" severity="error" size="small" variant="simple">{{ $form.job_description.error?.message }}
                            </Message>
                        </div>
                        
                        <div class="grid grid-cols-4 gap-4">
                            <Button type="submit" severity="info" label="Submit" />
                        </div>

                    </Form>
                </template>
            </Card>
            <div class="card mt-2 flex flex-start">
                <div class="card w-full">
                    
                </div>
            </div>
        </div>
        <div class="mt-2 card flex justify-center">



        </div>
    </AppLayout>
</template>