<template>
    <div class="row mx-auto">
        <div class="col-md p-0 border">
            <ul class="nav float-right p-0" dir="rtl">
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="خلاصه" class="fa nav-link fa-eercast"></i>
                </li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="درشت" class="fa nav-link fa-bold"></i>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="مورب" class="fa nav-link fa-italic"></i>
                </li>
                <li class="nav-item border-right"></li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="پیوند" class="fa nav-link fa-link"></i>
                </li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="نقل قول" class="fa nav-link fa-quote-right"></i>
                </li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="قرار دادن کد" class="fa nav-link fa-code"></i>
                </li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="قرار دادن تصویر" class="fa nav-link fa-picture-o"></i>
                </li>
                <li class="nav-item border-right"></li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="فهرست بی شماره" class="fa nav-link fa-list-ul"></i>
                </li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="فهرست با شماره" class="fa nav-link fa-list-ol"></i>
                </li>
                <li class="nav-item border-right"></li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="عنوان" class="fa nav-link fa-header"></i>
                </li>
                <li class="nav-item">
                    <i role="button" data-toggle="tooltip" title="خط افقی" class="fa nav-link fa-minus"></i>
                </li>
            </ul>
            <ul class="nav float-left mx-2">
                <li class="nav-item"><span>کلمه : {{WordCount}}</span></li>
            </ul>
        </div>
        <textarea :dir="vdir" :id="vname" :name="vname" :class="'form-control ' + vclass" placeholder="متن مورد نظر خود را وارد کنید ..." rows="12" v-on:keydown="CountWords">
            {{this.text}}
        </textarea>
    </div>
</template>

<script>
export default {
    props: {
        vname: {
            default: "markdowneditor",
        },
        vclass: {
            default: "",
        },
        vdir: {
            default: "rtl",
        },
    },
    data() {
        return {
            WordCount: 0,
            text: ""
        };
    },
    methods: {
        CountWords: function (element) {
            var str = element.target.value;
            str = str.replace(/(^\s*)|(\s*$)/gi, "");
            str = str.replace(/[ ]{2,}/gi, " ");
            str = str.replace(/\n /, "\n");
            this.WordCount = str.split(" ").length;
        },
        GetSelected: function () {
            var txtarea = $("#my-text-area");
            var start = txtarea.selectionStart;
            var finish = txtarea.selectionEnd;
            var sel = txtarea.value.substring(start, finish);
            return sel;
        },
    },
    mounted() {
        this.text = this.$slots.default ? this.$slots.default[0].text.trim() : '';
    },
};
</script>
