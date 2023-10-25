<template>
    <AppLayout title="Edit company">

        <template #header>
            <Breadcrumb :href="'companies'" :title="'companies'" :property="company" />
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="w-full max-w-xs m-auto">
                    <form @submit.prevent="submit" class="px-8 pt-6 pb-8 mb-4 bg-white rounded shadow-md">

                         <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.name"
                                class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="name" type="text">
                            <span class="text-red-500">{{ errors.name }}</span>
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
                            <div class="mb-3 xl:w-96">
                                
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="logo">
                                Logo <span class="text-red-500">*</span>
                            </label>
                            <input type="file" id="logo" v-on:change="form.logo = $event.target.files[0]">
                            <span class="text-red-500">{{ errors.logo }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="website">
                                Website <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.website"
                                class="w-full px-3 py-2 mb-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="website" type="text">
                            <span class="text-red-500">{{ errors.website }}</span>
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
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Button from "@/Components/Button.vue";
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
        Breadcrumb,
        Button
    },
    props: {
        company: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.company.name,
                email: this.company.email,
            })
        }
    },
    methods: {
        submit() {
            this.form.put(this.route('companies.update', this.company.id), {
                _token: this.$page.props.csrf_token,
            })
        }
    }
}
</script>