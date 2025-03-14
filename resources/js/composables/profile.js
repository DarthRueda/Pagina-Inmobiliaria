import { ref, inject, computed, watchEffect } from 'vue'
import { useRouter } from 'vue-router'
import { authStore } from "../store/auth";
import axios from 'axios'

export default function useProfile() {
    const auth = authStore();//Agafem el store d'autenticacio
    const profile = ref({
        name: '',
        email: '',
    })
    //  Sincronitzem el perfil quan `auth.user` canvia
    watchEffect(() => {
        if (auth.user) {
            profile.value = { ...auth.user };
        }
    });

    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getProfile = async () => {
        profile.value = auth.user;
    }

    const updateProfile = async (profile) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        axios.put('/api/user', profile)
            .then(({data}) => {
                if (data.success) {
                    auth.user.value=data.data
                    swal({
                        icon: 'success',
                        title: 'Profile updated successfully'
                    })
                }
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }


    return {
        profile,
        getProfile,
        updateProfile,
        validationErrors,
        isLoading
    }
}
