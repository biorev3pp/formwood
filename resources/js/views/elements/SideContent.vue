<template>
    <div class="content-scroll">
        <h3>{{ side_title }}
            <span class="info-icon">
                <fa-icon icon="fa-solid fa-info-circle" @click="showImage" v-if="side_img" />
            </span>
        </h3>
        <p>{{ side_description }}</p>
    </div>
</template>
<script>

export default {
    name: 'SideContent',
    props: {
        data: Object,
        step: Number
    },
    computed: {
        side_title() {
            if(this.data && this.data['step'+this.step+'_side_title']) {
                return this.data['step'+this.step+'_side_title']
            }
            return 'Step '+this.step
        },
        side_img() {
            if(this.data && this.data['step'+this.step+'_popup_image']) {
                return this.data['step'+this.step+'_popup_image']
            }
            return ''
        },
        side_description() {
            if(this.data && this.data['step'+this.step+'_side_description']) {
                return this.data['step'+this.step+'_side_description']
            } else {
                return ''
            }
        }
    },
    methods: {
        showImage() {
            this.$swal.fire({
                imageUrl: this.$host+'/media/'+this.side_img,
            })
        }
    }
}
</script>