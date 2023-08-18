<template>
    <div
        :title="i18nt('designer.toolbar.preview')"
        :show-close="true"
        :close-on-click-modal="false"
        :close-on-press-escape="false"
        center
        :destroy-on-close="true"
        :append-to-body="true"
        custom-class="drag-dialog small-padding-dialog"
        width="75%"
        :fullscreen="layoutType === 'H5' || layoutType === 'Pad'">
        <div>
            <div
                class="form-render-wrapper" >
                <VFormRender
                    ref="preForm"
                    :form-json="formJson"
                    :form-data="testFormData"
                    :preview-state="true"
                    :option-data="testOptionData"
                    @myEmitTest="onMyEmitTest"
                    @appendButtonClick="testOnAppendButtonClick"
                    @buttonClick="testOnButtonClick"
                    @formChange="handleFormChange"></VFormRender>
            </div>
        </div>
    </div>
</template>

<script>
    import VFormRender from "@/components/form-render/index";
    import CodeEditor from "@/components/code-editor/index";
    import Clipboard from "clipboard";
    import {
        deepClone,
        copyToClipboard,
        generateId,
        getQueryParam,
        traverseAllWidgets,
        addWindowResizeHandler,
        loadWidgetList,
        loadFormConfig,
        saveFormConfig
    } from "@/utils/util";
    import i18n from "@/utils/i18n";
    import { generateCode } from "@/utils/code-generator";
    import { genSFC } from "@/utils/sfc-generator";
    import loadBeautifier from "@/utils/beautifierLoader";
    import { saveAs } from "file-saver";
    import axios from "axios";
    import SvgIcon from "../svg-icon/index";
    import {
        ArrowLeft,
        ArrowRight,
        Delete,
        Edit,
        Share
    } from "@element-plus/icons-vue";
    import { VARIANT_FORM_VERSION } from "@/utils/config";
    import {
        getOnePageApplication
    } from "@/components/service/service-volcator";

    export default {
        name: "ToolbarPanel",
        components: {
            VFormRender,
            CodeEditor,
            Clipboard,
            SvgIcon
        },
        mixins: [i18n],
        provide() {
            return {
                refList: this.widgetRefList,
                getFormConfig: () => loadFormConfig() /* TODO: load from webservice */,
                globalOptionData: this.optionData,
                getOptionData: () => this.optionData,
                globalModel: {
                    formModel: this.formModel
                }
            };
        },
        inject: ["getDesignerConfig"],
        props: {
            designer: Object,

        },
        data() {
            return {
                switchDisplay: "PC",
                toolbarWidth: 420,
                showPreviewDialogFlag: true,
                showImportJsonDialogFlag: false,
                showExportJsonDialogFlag: false,
                showExportCodeDialogFlag: false,
                showFormDataDialogFlag: false,
                showExportSFCDialogFlag: false,
                showNodeTreeDrawerFlag: false,

                nodeTreeData: [],

                importTemplate: "",
                jsonContent: "",
                jsonRawContent: "",

                formDataJson: "",
                formDataRawJson: "",

                vueCode: "",
                htmlCode: "",

                sfcCode: "",
                sfcCodeV3: "",

                activeCodeTab: "vue",
                activeSFCTab: "vue2",

                testFormData: {
                    // 'userName': '666888',
                    // 'productItems': [
                    //   {'pName': 'iPhone12', 'pNum': 10},
                    //   {'pName': 'P50', 'pNum': 16},
                    // ]

                    select62173: 2
                },
                testOptionData: {
                    select62173: [
                        { label: "01", value: 1 },
                        { label: "22", value: 2 },
                        { label: "333", value: 3 }
                    ],

                    select001: [
                        { label: "辣椒", value: 1 },
                        { label: "菠萝", value: 2 },
                        { label: "丑橘子", value: 3 }
                    ]
                },
                widgetList: null,
                formConfig: null,
            };
        },
        computed: {
            formJson() {
                console.log("XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                getOnePageApplication('vapp_s1_a1', '64df583d3aa413693c599e59').then(response => {
                    this.widgetList = response[0].widgetList;
                    this.formConfig = response[0].formConfig;
                    deepClone(this.widgetList),
                        deepClone(this.formConfig)
                }).catch(error => {
                    console.error(error);
                });
                return {
                    widgetList: deepClone(this.widgetList),
                    formConfig: deepClone(this.formConfig)
                    // widgetList: this.widgetList,
                    // formConfig: this.formConfig
                };
            },
            // formJson() {
            //     return this.loadApplicationByName('vapp_s1_a1', '64df583d3aa413693c599e59');
            //     return {
            //
            //         /* TODO: load from webservice */
            //         widgetList: loadWidgetList(),
            //         formConfig: loadFormConfig()
            //     };
            //
            // },
        },
        watch: {
            // this.loadApplicationByName('vapp_s1_a1', '64df583d3aa413693c599e59');

            "designer.widgetList": {
                deep: true,
                handler(val) {
                    //
                }
            }
        },
        mounted() {
             //


        },
        created() {

            let formConfig = loadFormConfig();
            formConfig.previewOrRender  = true;
            saveFormConfig(formConfig);
        },
        methods: {
            //
            // loadApplicationByName(applicationName, applicationId) {
            // loadApplicationByName(applicationName, applicationId) {
            //     getOnePageApplication(applicationName, applicationId).then(response => {
            //         this.widgetList = response[0].widgetList;
            //         this.formConfig = response[0].formConfig;
            //     }).catch(error => {
            //         console.error(error);
            //     });
            // },
        }
    };
</script>

<style lang="scss" scoped>
    .radio-group-custom {
        :deep(.el-radio-button__inner) {
            margin-top: -5px;
            padding-left: 12px;
            padding-right: 12px;
        }
    }

    div.toolbar-container {
        //min-width: 728px;  /* 解决工具按钮栏换行的问题！！ */
        /* 上一行css有问题，当窗口宽度不足时会把按钮挤出到右边的属性设置区，弃之！ */
    }

    .left-toolbar {
        display: flex;
        /*margin-top: 4px;*/
        float: left;
        font-size: 16px;
    }

    /*.right-toolbar {*/
    /*    display: flex;*/
    /*    !*margin-top: 5px;*!*/
    /*    float: right;*/
    /*    text-align: right;*/
    /*    overflow: hidden;*/

    /*    .right-toolbar-con {*/
    /*        text-align: left;*/
    /*        width: 600px;*/
    /*    }*/

    /*    :deep(.el-button) {*/
    /*        margin-left: 10px;*/
    /*    }*/

    /*    :deep(.el-button--text) {*/
    /*        font-size: 14px !important;*/
    /*    }*/

    /*    :deep(.svg-icon) {*/
    /*        margin-left: 0;*/
    /*        margin-right: 0.05em;*/
    /*    }*/
    /*}*/

    .el-button i {
        margin-right: 3px;
    }

    .small-padding-dialog {
        :deep(.el-dialog__header) {
            //padding-top: 3px;
            //padding-bottom: 3px;
            background: #f1f2f3;
        }

        :deep(.el-dialog__body) {
            padding: 12px 15px 12px 15px;

            .el-alert.alert-padding {
                padding: 0 10px;
            }
        }

        :deep(.ace-container) {
            border: 1px solid #dcdfe6;
        }
    }

    .dialog-title-light-bg {
        :deep(.el-dialog__header) {
            background: #f1f2f3;
        }
    }

    .no-box-shadow {
        box-shadow: none;
    }

    .no-padding.el-tabs--border-card {
        :deep(.el-tabs__content) {
            padding: 0;
        }
    }

    .form-render-wrapper {
        //height: calc(100vh - 142px);
        //all: revert !important; /* 防止表单继承el-dialog等外部样式，未生效，原因不明？？ */
    }

    .form-render-wrapper.h5-layout {
        margin: 0 auto;
        width: 420px;
        border-radius: 15px;
        //border-width: 10px;
        box-shadow: 0 0 1px 10px #495060;
        height: calc(100vh - 175px);
        overflow-y: auto;
        overflow-x: hidden;
    }

    .form-render-wrapper.pad-layout {
        margin: 0 auto;
        width: 960px;
        border-radius: 15px;
        //border-width: 10px;
        box-shadow: 0 0 1px 10px #495060;
        height: calc(100vh - 175px);
        overflow-y: auto;
        overflow-x: hidden;
    }

    .node-tree-drawer {
        :deep(.el-drawer) {
            padding: 10px;
            overflow: auto;
        }

        :deep(.el-drawer__header) {
            margin-bottom: 12px;
            padding: 5px 5px 0;
        }

        :deep(.el-drawer__body) {
            padding-left: 5px;
        }
    }

    /*.node-tree-scroll-bar {*/
    /*  height: 100%;*/
    /*  overflow: auto;*/
    /*}*/

    :deep(.node-tree) {
        .el-tree > .el-tree-node:after {
            border-top: none;
        }

        .el-tree-node {
            position: relative;
            padding-left: 12px;
        }

        .el-tree-node__content {
            padding-left: 0 !important;
        }

        .el-tree-node__expand-icon.is-leaf {
            display: none;
        }

        .el-tree-node__children {
            padding-left: 12px;
            overflow: visible !important; /* 加入此行让el-tree宽度自动撑开，超出宽度el-draw自动出现水平滚动条！ */
        }

        .el-tree-node :last-child:before {
            height: 38px;
        }

        .el-tree > .el-tree-node:before {
            border-left: none;
        }

        .el-tree > .el-tree-node:after {
            border-top: none;
        }

        .el-tree-node:before {
            content: '';
            left: -4px;
            position: absolute;
            right: auto;
            border-width: 1px;
        }

        .el-tree-node:after {
            content: '';
            left: -4px;
            position: absolute;
            right: auto;
            border-width: 1px;
        }

        .el-tree-node:before {
            border-left: 1px dashed #4386c6;
            bottom: 0px;
            height: 100%;
            top: -10px;
            width: 1px;
        }

        .el-tree-node:after {
            border-top: 1px dashed #4386c6;
            height: 20px;
            top: 12px;
            width: 16px;
        }

        .el-tree-node.is-current > .el-tree-node__content {
            background: #c2d6ea !important;
        }

        .el-tree-node__expand-icon {
            margin-left: -3px;
            padding: 6px 6px 6px 0px;
            font-size: 16px;
        }
    }
</style>
