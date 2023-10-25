<template>
    <AppLayout title="Company profile">
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="w-full max-w-lg overflow-hidden bg-white rounded-lg shadow-lg">
                <img class="object-cover w-full h-64" :src="user.coverImage" alt="Logoe">
                <div class="p-4">

                   

                    <h1 class="text-2xl font-bold text-center">{{ getEmployee.first_name }}</h1>
                    <h1 class="text-2xl font-bold text-center">{{ getEmployee.last_name }}</h1>
                    <center>
                        <a :href="'mailto:' + getEmployee.email" class="text-center text-gray-600">{{ getEmployee.email }}</a>
                    </center>
					<h1 class="text-2xl font-bold text-center">{{ getEmployee.phone }}</h1>
                    <hr class="my-4">
                    
                </div>
            </div>
        </div>
    </AppLayout>
</template>
  
<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },
    props: {
        getCompany: Object,
        logo: String
    },
    data() {
        return {
            user: {},
        }
    },
    computed: {
        userlogo() {
            return this.getCompany.logo !== 'placeholder'
                ? this.getCompany.logo
                : this.$page.props.logo;
        }
    },
    mounted() {
        this.user = Object.assign(this.user, {
            profileImage: 'https://randomuser.me/api/portraits/men/10.jpg',
            coverImage: 'https://www.itnewsafrica.com/wp-content/uploads/2022/07/Software-Devs.jpg',
            about: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at dictum est. Sed id lacus ut ipsum semper lobortis vel non metus. Duis sit amet orci metus. Suspendisse at leo est. Nullam tincidunt, tellus sed vestibulum scelerisque, nisl mauris varius mauris, in scelerisque mi orci eget tortor.',
        });
        this.$forceUpdate();
    }
}
</script>
