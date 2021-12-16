<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <input type="text" 
                                    v-model="message" 
                                    v-on:keyup.enter="send"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                            &nbsp;
                            <button type="button" v-on:click="send" v-if="message.length > 0"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                Отправить
                            </button>
                            <button type="button" v-else disabled
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                                Отправить
                            </button>
                        </form>
                        <div id="message-list">
                            <div v-for="message in messageList" 
                                style="margin: 20px; padding: 10px; border: 1px solid #000; border-radius: 10px; background-color: #e0e0e0;">
                                {{ message.created_at.substr(11,8) }} <b>{{ message.user_name }}</b>:<br />
                                {{ message.message }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'

    export default {
        components: {
            BreezeAuthenticatedLayout,
        },
        created: function () {
            this.get();
            const component = this;
            setInterval(function () { component.get(); }, 5000);
        },
        data() {
            return {
                message: "",
                messageList: []
            }
        },
        methods: {
            get() {
                const component = this;
                axios.get(
                    '/get-messages'
                ).then(function (response) {
                    component.messageList = response.data;
                })
                .catch(function (error) {
                    alert("Ошибка: " + error);
                });
            },
            send() {
                if (this.message.length < 1) {
                    return;
                }
                console.log("Message: " + this.message);
                const csrftoken = document.querySelector("meta[name=csrf-token]").getAttribute("content");
                console.log("CSRF token: " + csrftoken);

                const params = new URLSearchParams();
                params.append("message", this.message);
                const component = this;

                axios.post(
                    '/send',
                    params,
                    {
                        headers: { 'X-CSRFToken': csrftoken },
                        'Content-Type' : 'application/json; charset=UTF-8',
                    }
                ).then(function (response) {
                    console.log("Response: " + response);
                    component.message = "";
                    component.get();
                })
                .catch(function (error) {
                    alert("Ошибка: " + error);
                });
            }
        }
    }
</script>
