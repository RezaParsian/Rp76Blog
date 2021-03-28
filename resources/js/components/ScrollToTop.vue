<template>
    <button
    type="button"
    data-toggle="tooltip"
    title="بروبالا"
    class="scrolltotop btn rounded-pill position-relative text-white-50"
    @click="Scroll"
    >
    <i class="fa fa-chevron-up"></i>
    </button>
</template>

<script>
export default {
    methods:{
        Scroll() {
            scrollTo(0, 0);
        },
    }
};
</script>
