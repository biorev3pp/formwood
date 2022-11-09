<template>
    <em class="fst-normal">{{step_title}}</em>
</template>
<script>

export default {
    name: 'StepTitle',
    props: {
        data: Object,
        step: Number
    },
    computed: {
        step_title() {
            if(this.data && this.data['step'+this.step+'_main_title']) {
                return this.data['step'+this.step+'_main_title']
            }
            return 'Step '+this.step
        }
    }
}
</script>