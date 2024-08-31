import '@uppy/core/dist/style.min.css';
import '@uppy/dashboard/dist/style.min.css';

import Uppy from '@uppy/core';
import Dashboard from '@uppy/dashboard';
import Tus from "@uppy/tus";

function boot() {
    Alpine.data('TusUppy', function ({endpoint}){
        return {
            endpoint,
            init() {
                this.render();
            },

            render() {
                let el = this.$refs.uploadContainer

                this.uppy = new Uppy({debug: true, autoProceed: false})
                    .use(Dashboard, {target: el, inline: true, theme: 'auto'})
                    .use(Tus, {
                        endpoint: this.endpoint,
                        withCredentials: true,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                    })


                console.log(el);
            }
        }
    })
}


if (window.Alpine) {
    boot()

    // Your code here
} else {
    // If Alpine hasn't started yet, wait for the `alpine:init` event
    document.addEventListener('alpine:init', () => {
        boot()

        // Your code here
    });
}
