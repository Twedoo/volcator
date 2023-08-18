<template>
    <static-content-wrapper
        :designer="designer"
        :field="field"
        :design-state="designState"
        :display-style="'inline'"
        :parent-widget="parentWidget"
        :parent-list="parentList"
        :index-of-parent-list="indexOfParentList"
        :sub-form-row-index="subFormRowIndex"
        :sub-form-col-index="subFormColIndex"
        :sub-form-row-id="subFormRowId">
        <span  v-if="statusPreviewOrRender === false"
            :class="[
                width,
                height,
                margin,
                padding,
                border,
                pictureBgSize,
                pictureBgRepeat,
                pictureBgOrigin,
                pictureBgPosition,
                pictureBgAttachment,
                'image-input'
            ]"
            :style="{ 'background-image': `url(${uploadURL})` }"
            @click="chooseImage">
            <span v-if="!uploadURL" class="placeholder">
              Choose an Image
            </span>
            <input class="file-input"
                ref="fileInput"
                type="file"
                @input="onSelectFile">
         </span>

        <span  v-else-if="statusPreviewOrRender === true"
               :class="[
                width,
                height,
                margin,
                padding,
                border,
                pictureBgSize,
                pictureBgRepeat,
                pictureBgOrigin,
                pictureBgPosition,
                pictureBgAttachment,
                'image-input'
            ]"
           :style="{ 'background-image': `url(${uploadURL})` }">
         </span>
    </static-content-wrapper>
</template>

<script>
    import StaticContentWrapper from './static-content-wrapper';
    import FormItemWrapperWithoutLabel from './form-item-wrapper-without-label';
    import emitter from '@/utils/emitter';
    import i18n, { translate } from '@/utils/i18n';
    import { deepClone } from '@/utils/util';
    import fieldMixin from '@/components/form-designer/form-widget/field-widget/fieldMixin';
    import dimensionBasicSettingMixin from "@/components/form-designer/form-widget/dimensionBasicSettingMixin";
    import pictureSettingMixin from "@/components/form-designer/form-widget/pictureSettingMixin";
    import SvgIcon from '@/components/svg-icon/index';
    import { uploadImage } from "@/components/service/service-asset-storage.js";
    import { loadFormConfigByElement } from "@/utils/util";

    export default {
        name: 'PictureSpaceWidget',
        componentName: 'FieldWidget',
        components: {
            FormItemWrapperWithoutLabel,
            StaticContentWrapper,
            SvgIcon,
        },
        mixins: [emitter, fieldMixin, i18n, dimensionBasicSettingMixin, pictureSettingMixin],
        props: {
            field: Object,
            parentWidget: Object,
            parentList: Array,
            indexOfParentList: Number,
            designer: Object,

            designState: {
                type: Boolean,
                default: false,
            },

            subFormRowIndex: {
                /* 子表单组件行索引，从0开始计数 */ type: Number,
                default: -1,
            },
            subFormColIndex: {
                /* 子表单组件列索引，从0开始计数 */ type: Number,
                default: -1,
            },
            subFormRowId: {
                /* 子表单组件行Id，唯一id且不可变 */ type: String,
                default: '',
            },
        },
        data() {
            return {
                uploadURL: null,
                oldFieldValue: null, //field组件change之前的值
                fieldModel: [],
                rules: [],

                uploadHeaders: {},
                uploadData: {
                    key: '',
                    //token: '',

                    //policy: '',
                    //authorization: '',
                },
                fileList: [],
                fileListBeforeRemove: [],
                uploadBtnHidden: false,

                previewIndex: 1,
                fileSelected: null,
            };
        },
        computed: {
            previewList() {
                return this.fileList.map((el) => el.url);
            },
            statusPreviewOrRender() {
                return loadFormConfigByElement('previewOrRender');
            },
        },
        beforeCreate() {
            /* 这里不能访问方法和属性！！ */
        },

        created() {
            /* 注意：子组件mounted在父组件created之后、父组件mounted之前触发，故子组件mounted需要用到的prop
             需要在父组件created中初始化！！ */
            this.initFieldModel();
            this.registerToRefList();
            this.initEventHandler();
            this.buildFieldRules();

            this.handleOnCreated();
            this.uploadURL = this.field.options.uploadURL;
        },

        mounted() {

            this.handleOnMounted();
        },

        beforeUnmount() {
            this.unregisterFromRefList();
        },

        methods: {
            chooseImage() {
                this.$refs.fileInput.click()
            },

            onSelectFile() {
                const input = this.$refs.fileInput
                const files = input.files
                if (files && files[0]) {
                    const countryIsoCode = 'en';
                    const module = 'application';

                    const params = { file: files[0]  };

                    uploadImage(countryIsoCode, module, params).then(response => {
                        const reader = new FileReader
                        reader.onload = e => {
                            this.field.options.uploadURL = e.target.result;
                            this.uploadURL = this.field.options.uploadURL;
                        }
                        reader.readAsDataURL(files[0])
                        this.$emit('input', files[0])

                    }).catch(error => {
                            console.error('No data.', error);
                    });
                }
            }
        }
    };

</script>

<style lang="scss" scoped>
    @import '../../../../styles/global.scss'; /* form-item-wrapper已引入，还需要重复引入吗？ */

    .image-input {
        display: inline-block;
        /*width: 400px;*/
        /*height: 400px;*/
        cursor: pointer;
        /*background-size: cover;*/
        /*background-position: center center;*/
    }

    .placeholder {
        background: #F0F0F0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #333;
        font-size: 18px;
        font-family: 'Helvetica',serif;
    }

    .placeholder:hover {
        background: #E0E0E0
    }

    .file-input {
        display: none
    }

    .full-width-input {
        width: auto !important;
    }

    .hideUploadDiv {
        :deep(div.el-upload--picture-card) {
            /* 隐藏最后的图片上传按钮 */
            display: none;
        }

        :deep(div.el-upload--text) {
            /* 隐藏最后的文件上传按钮 */
            display: none;
        }

        :deep(div.el-upload__tip) {
            /* 隐藏最后的文件上传按钮提示 */
            display: none;
        }
    }

    .uploader-icon {
        height: 100%;
        display: flex;
        color: #8c939d;
        font-size: 28px;
        justify-content: center;
        align-items: center;
    }
</style>
