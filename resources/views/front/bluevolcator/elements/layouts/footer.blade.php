<!-- Call To Action -->
<div class="pt-12 pb-12 bg-gray-100 border-b border-gray-200">
    <div class="px-5 max-w-xl mx-auto">
        <div class="text-1xl lg:text-2xl font-headline tracking-tight text-center leading-snug text-gray-900">
            <p>Already convinced?</p>
            <p class="mt-3 font-semibold">Get ready to leap your business into the future.</p>
        </div>

        <!--                 <div class="mt-4 text-lg text-gray-700 text-center">
                            Deploying your first serverless application has never been easier. There’s no need to spend weeks pouring over documentation and blog posts.
                        </div> -->

{{--        <div class="mt-8 text-center">--}}
{{--            <a href="https://vapor.laravel.com/register" class="inline-block px-4 py-3 leading-none rounded bg-cyan-500 text-white font-medium">--}}
{{--                Sign Up Now--}}
{{--            </a>--}}
{{--        </div>--}}

                         <div id="form" class="lg:mx-auto">
                            <form class="mt-6 sm:flex sm:items-center lg:justify-center" @submit.prevent="onSubmit" v-if="! submitted">
                                <div class="relative sm:w-full sm:max-w-xs">
                                    <div class="pointer-events-none flex items-center absolute inset-y-0 left-0 pl-3">
                                        <svg class="h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M4 4h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm.32 1.616a.5.5 0 1 0-.64.768l6 5a.5.5 0 0 0 .64 0l6-5a.5.5 0 0 0-.64-.768L10 10.349 4.32 5.616z" fill="#BBC2C8" fill-rule="evenodd"/></svg>
                                    </div>

                                    <input type="email" name="email" class="pl-12 block w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-cyan-500" placeholder="Your email" v-model="email" required>
                                </div>

                                <button class="mt-4 sm:ml-4 sm:mt-0 w-full sm:w-auto sm:flex-shrink-0 block px-4 py-3 leading-none rounded bg-cyan-500 text-white font-medium focus:outline-none focus:shadow-outline" :class="{ 'opacity-50': submitting }" :disabled="submitting">
                                    Get news Twedoo
                                </button>
                            </form>

                            <div class="mt-6 px-4 py-4 bg-gray-100 rounded-lg text-center" v-else>
                                You're on the list!
                            </div>
                        </div>
    </div>
</div>

<!-- Copyright -->
<div class="pt-6 pb-6 bg-gray-100 text-gray-500">
    <div class="flex items-center justify-between px-5 max-w-xl md:max-w-2xl lg:max-w-5xl mx-auto">
        <div>
            © Twedoo - 2020
        </div>

        <div>
            <a href="https://twitter.com/twedoo">
                <svg viewBox="0 0 21 21" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"><path d="M17.762 5.53a4.024 4.024 0 0 0 1.714-2.234 7.63 7.63 0 0 1-2.477.979A3.826 3.826 0 0 0 14.154 3c-2.151 0-3.897 1.809-3.897 4.039 0 .317.034.624.1.92-3.239-.169-6.11-1.775-8.034-4.222a4.146 4.146 0 0 0-.528 2.033c0 1.4.688 2.637 1.734 3.362a3.797 3.797 0 0 1-1.766-.504v.05c0 1.957 1.344 3.59 3.128 3.96a3.68 3.68 0 0 1-1.027.142c-.251 0-.496-.024-.734-.071.496 1.604 1.935 2.772 3.641 2.803A7.648 7.648 0 0 1 1 17.187 10.772 10.772 0 0 0 6.975 19c7.171 0 11.091-6.154 11.091-11.492 0-.175-.003-.351-.01-.523A8.05 8.05 0 0 0 20 4.895a7.553 7.553 0 0 1-2.238.635z" fill="#6E767E" fill-rule="evenodd"></path></svg>
            </a>
        </div>
    </div>
</div>

<script>
    var app = new Vue({
        el: '#form',
        data: {
            email: '',
            submitted: false,
            submitting: false
        },
        methods: {
            onSubmit: function () {
                this.submitting = true;

                fetch('/api/early-access', {
                    method: 'POST',
                    body: JSON.stringify({ email: this.email }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    this.submitted = true;
                    this.submitting = false;
                });
            }
        }
    })
</script>
