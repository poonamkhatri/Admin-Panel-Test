<template>
    <AppLayout title="Update Employee">

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Update Employee
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full max-w-xs m-auto">

                    <form @submit.prevent="submit" class="px-8 pt-6 pb-8 m-auto mb-4 bg-white rounded shadow-md"
                        enctype="multipart/form-data">

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="first_name">
                               First Name <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.first_name"
                                class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="first_name" type="text">
                            <span class="text-red-500">{{ errors.first_name }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="last_name">
                               Last Name <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.last_name"
                                class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="first_name" type="text">
                            <span class="text-red-500">{{ errors.last_name }}</span>
                        </div>

                        
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                E-mail <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.email"
                                class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="email" type="email">
                            <span class="text-red-500">{{ errors.email }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="compnany_id">
                                Select Company Name <span class="text-red-500">*</span>
                            </label>
                            <select name="company_id" id="company_id" v-model="form.company_id" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                <option v-for="company in companies" :key="company.id" :value="company.id" >{{company.name}}</option>
                            </select>
                            <span class="text-red-500">{{ errors.company_id }}</span>
                        </div>


                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="phone">
                               Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.phone"
                                class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="phone" type="text">
                            <span class="text-red-500">{{ errors.phone }}</span>
                        </div>
						
						
						

                        <div class="mb-4">
                            <div class="mb-3 xl:w-96">
                                
                            </div>
                        </div>

                        

                        

                        <div class="flex items-center justify-between">
                            <Button :form="form"></Button>
                        </div>
                    </form>

                   
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import Button from '@/Components/Button.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
        Button,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                first_name: '',
                last_name: '',
                email: '',
                company_id: '',
                phone: '',
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('employees.update'), {
                _token: this.$page.props.csrf_token,
            });
        }
    }
}
</script>