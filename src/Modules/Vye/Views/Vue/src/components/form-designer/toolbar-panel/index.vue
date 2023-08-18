<template>
    <div class="toolbar-container">
        <div class="tw-grid tw-grid-cols-3 tw-gap-4 tw-mt-2">
            <div class="">
                <el-button-group class="">
                    <el-button
                        size="small"
                        class="tw-items-center tw-w-8 tw-mx-2"
                        @click="openVolcatorGate()">
                        <svg xmlns="http://www.w3.org/2000/svg" height="15px" width="15px" fill="#6e6ead"
                             viewBox="0 0 576 512"><!--! Font Awesome Pro 6.0.0-alpha3 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->

                            <path class="fa-primary"
                                  d="M575.1 256c0 24.48-22.19 31.1-32.01 31.1c-7.469 0-14.99-2.595-21.07-7.907L288 74.54L53.08 280.1C46.99 285.4 39.48 287.1 32 287.1c-9.626-.0021-32-7.621-32-31.1c0-7.38 2.671-16.86 10.92-24.09l255.1-223.1c6.031-5.281 13.55-7.919 21.08-7.919s15.05 2.638 21.08 7.919l106.9 93.55V47.98c0-8.828 7.156-15.1 15.1-15.1l63.1 .0074c8.844 0 15.1 7.172 15.1 15.1l-.0036 137.5l53.08 46.45C573.3 239.2 575.1 248.6 575.1 256z"/>
                            <path class="fa-secondary"
                                  d="M288 74.54L64.02 270.5l-.0108 177.5c0 35.35 28.65 63.1 63.1 63.1h319.1c35.35 0 63.1-28.65 63.1-63.1l-.002-177.5L288 74.54zM351.2 346.6c0 11.88-9.625 21.38-21.38 21.38H244.6c-11.75 0-21.37-9.625-21.37-21.38V261.4C223.2 249.5 232.8 240 244.6 240h85.24c11.75 0 21.38 9.5 21.38 21.38V346.6z"/>
                        </svg>
                    </el-button>
                    <el-button
                        size="small"
                        :disabled="undoDisabled"
                        class="tw-items-center tw-w-8"
                        @click="undoHistory">
                        <svg-icon :icon-class="'rotate-left'" class-name="tw-text-l" />
                    </el-button>
                    <el-button
                        size="small"
                        :disabled="redoDisabled"
                        class="tw-items-center tw-w-8"
                        @click="redoHistory">
                        <svg-icon :icon-class="'rotate-right'" class-name="tw-text-l" />
                    </el-button>
                    <el-button
                        size="small"
                        class="tw-items-center tw-w-8"
                        :title="i18nt('designer.toolbar.droppableButton')"
                        @click="containerDroppableHighlight">
                        <svg-icon
                            v-if="isContainerDroppableHighlight"
                            :icon-class="'droplet'"
                            class-name="tw-text-l" />
                        <svg-icon
                            v-else
                            :icon-class="'droplet-slash'"
                            class-name="tw-text-l" />
                    </el-button>
                </el-button-group>
            </div>
            <div class="">
                <el-radio-group v-model="switchDisplay" class="radio-group-custom">
                    <el-radio-button
                        label="PC"
                        size="small"
                        :type="layoutType === 'PC' ? 'info' : ''"
                        @click="changeLayoutType('PC')">
                        <svg-icon :icon-class="'display-code'" class-name="tw-text-l" />
                    </el-radio-button>
                    <el-radio-button
                        label="Pad"
                        size="small"
                        :type="layoutType === 'Pad' ? 'info' : ''"
                        @click="changeLayoutType('Pad')">
                        <svg-icon :icon-class="'tablet-button'" class-name="tw-text-l" />
                    </el-radio-button>
                    <el-radio-button
                        label="H5"
                        size="small"
                        :type="layoutType === 'H5' ? 'info' : ''"
                        @click="changeLayoutType('H5')">
                        <svg-icon :icon-class="'mobile-notch'" class-name="tw-text-l" />
                    </el-radio-button>
                </el-radio-group>
                <el-button
                    size="small"
                    style="margin-left: 20px; background: #ffffff"
                    class="tw-mt-"
                    @click="showNodeTreeDrawer">
                    <svg-icon :icon-class="'list-tree'" class-name="tw-text-l" />
                </el-button>
            </div>
            <div class="">
                <el-drawer
                    v-model="showNodeTreeDrawerFlag"
                    :title="i18nt('designer.toolbar.nodeTreeTitle')"
                    direction="ltr"
                    :modal="true"
                    :size="280"
                    :destroy-on-close="true"
                    custom-class="node-tree-drawer">
                    <el-tree
                        ref="nodeTree"
                        :data="nodeTreeData"
                        node-key="id"
                        default-expand-all
                        highlight-current
                        class="node-tree"
                        icon-class="el-icon-arrow-right"
                        @node-click="onNodeTreeClick"></el-tree>
                </el-drawer>

                <div class="tw-float-right">
                    <el-radio-button
                        v-if="showToolButton('clearDesignerButton')"
                        size="small"
                        type="text"
                        @click="clearFormWidget">
                        <svg-icon :icon-class="'trash-can'" class-name="tw-text-l" />
                    </el-radio-button>
                    <el-radio-button
                        v-if="showToolButton('previewFormButton')"
                        size="small"
                        type="text"
                        @click="previewForm">
                        <svg-icon :icon-class="'eye'" class-name="tw-text-l" />
                    </el-radio-button>
                    <el-radio-button
                        v-if="showToolButton('importJsonButton')"
                        size="small"
                        type="text"
                        @click="importJson">
                        <svg-icon :icon-class="'upload'" class-name="tw-text-l" />
                    </el-radio-button>
                    <el-radio-button
                        v-if="showToolButton('exportJsonButton')"
                        size="small"
                        type="text"
                        @click="exportJson">
                        <svg-icon :icon-class="'download'" class-name="tw-text-l" />
                    </el-radio-button>
                    <el-radio-button
                        v-if="showToolButton('exportCodeButton')"
                        size="small"
                        type="text"
                        @click="exportCode">
                        <svg-icon :icon-class="'code'" class-name="tw-text-l" />
                    </el-radio-button>
                    <el-radio-button
                        v-if="showToolButton('generateSFCButton')"
                        size="small"
                        type="text"
                        @click="generateSFC">
                        <svg-icon :icon-class="'layer-group'" class-name="tw-text-l" />
                    </el-radio-button>
                    <template v-for="(idx, slotName) in $slots">
                        <slot :name="slotName"></slot>
                    </template>
                </div>
            </div>
        </div>

        <div
            v-if="showPreviewDialogFlag"
            v-drag="['.drag-dialog.el-dialog', '.drag-dialog .el-dialog__header']"
            class="">
            <el-dialog
                v-model="showPreviewDialogFlag"
                :title="i18nt('designer.toolbar.preview')"
                :show-close="true"
                :close-on-click-modal="false"
                :close-on-press-escape="false"
                center
                :destroy-on-close="true"
                :append-to-body="true"
                @close="closePreviewForm(false)"
                custom-class="drag-dialog small-padding-dialog"
                width="75%"
                :fullscreen="layoutType === 'H5' || layoutType === 'Pad'">
                <div>
                    <div
                        class="form-render-wrapper"
                        :class="[
							layoutType === 'H5'
								? 'h5-layout'
								: layoutType === 'Pad'
								? 'pad-layout'
								: '',
						]">
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
                <template #footer>
                    <div class="dialog-footer">
                        <el-button type="primary" @click="getFormData">
                            {{ i18nt("designer.hint.getFormData") }}
                        </el-button>
                        <el-button type="primary" @click="resetForm">
                            {{ i18nt("designer.hint.resetForm") }}
                        </el-button>
                        <el-button type="primary" @click="setFormDisabled">
                            {{ i18nt("designer.hint.disableForm") }}
                        </el-button>
                        <el-button type="primary" @click="setFormEnabled">
                            {{ i18nt("designer.hint.enableForm") }}
                        </el-button>
                        <el-button @click="closePreviewForm(false)">
                            {{ i18nt("designer.hint.closePreview") }}
                        </el-button>
                        <el-button v-if="false" @click="testLoadForm">Test Load</el-button>
                        <el-button v-if="false" @click="testSetFormJson">
                            Test SFJ
                        </el-button>
                        <el-button v-if="false" @click="testSetFormData">
                            Test SFD
                        </el-button>
                        <el-button v-if="false" @click="testReloadOptionData">
                            Test ROD
                        </el-button>
                    </div>
                </template>
            </el-dialog>
        </div>

        <div
            v-if="showImportJsonDialogFlag"
            v-drag="['.drag-dialog.el-dialog', '.drag-dialog .el-dialog__header']"
            class="">
            <el-dialog
                v-model="showImportJsonDialogFlag"
                :title="i18nt('designer.toolbar.importJson')"
                :show-close="true"
                custom-class="drag-dialog small-padding-dialog"
                :append-to-body="true"
                center
                :close-on-click-modal="false"
                :close-on-press-escape="false"
                :destroy-on-close="true">
                <el-alert
                    type="info"
                    :title="i18nt('designer.hint.importJsonHint')"
                    show-icon
                    class="alert-padding"></el-alert>
                <code-editor
                    v-model="importTemplate"
                    :mode="'json'"
                    :readonly="false"></code-editor>
                <template #footer>
                    <div class="dialog-footer">
                        <el-button type="primary" @click="doJsonImport">
                            {{ i18nt("designer.hint.import") }}
                        </el-button>
                        <el-button @click="showImportJsonDialogFlag = false">
                            {{ i18nt("designer.hint.cancel") }}
                        </el-button>
                    </div>
                </template>
            </el-dialog>
        </div>

        <div
            v-if="showExportJsonDialogFlag"
            v-drag="['.drag-dialog.el-dialog', '.drag-dialog .el-dialog__header']"
            class="">
            <el-dialog
                v-model="showExportJsonDialogFlag"
                :title="i18nt('designer.toolbar.exportJson')"
                :show-close="true"
                custom-class="drag-dialog small-padding-dialog"
                center
                :close-on-click-modal="false"
                :close-on-press-escape="false"
                :destroy-on-close="true">
                <code-editor
                    v-model="jsonContent"
                    :mode="'json'"
                    :readonly="true"></code-editor>
                <template #footer>
                    <div class="dialog-footer">
                        <el-button
                            type="primary"
                            class="copy-json-btn"
                            :data-clipboard-text="jsonRawContent"
                            @click="copyFormJson">
                            {{ i18nt("designer.hint.copyJson") }}
                        </el-button>
                        <el-button @click="saveFormJson">
                            {{ i18nt("designer.hint.saveFormJson") }}
                        </el-button>
                        <el-button @click="showExportJsonDialogFlag = false">
                            {{ i18nt("designer.hint.closePreview") }}
                        </el-button>
                    </div>
                </template>
            </el-dialog>
        </div>

        <div
            v-if="showExportCodeDialogFlag"
            v-drag="['.drag-dialog.el-dialog', '.drag-dialog .el-dialog__header']"
            class="">
            <el-dialog
                v-model="showExportCodeDialogFlag"
                :title="i18nt('designer.toolbar.exportCode')"
                :show-close="true"
                custom-class="drag-dialog small-padding-dialog"
                center
                width="65%"
                :close-on-click-modal="false"
                :close-on-press-escape="false"
                :destroy-on-close="true">
                <el-tabs
                    v-model="activeCodeTab"
                    type="border-card"
                    class="no-box-shadow no-padding">
                    <el-tab-pane label="Vue" name="vue">
                        <code-editor
                            v-model="vueCode"
                            :mode="'html'"
                            :readonly="true"
                            :user-worker="false"></code-editor>
                    </el-tab-pane>
                    <el-tab-pane label="HTML" name="html">
                        <code-editor
                            v-model="htmlCode"
                            :mode="'html'"
                            :readonly="true"
                            :user-worker="false"></code-editor>
                    </el-tab-pane>
                </el-tabs>
                <template #footer>
                    <div class="dialog-footer">
                        <el-button
                            type="primary"
                            class="copy-vue-btn"
                            :data-clipboard-text="vueCode"
                            @click="copyVueCode">
                            {{ i18nt("designer.hint.copyVueCode") }}
                        </el-button>
                        <el-button
                            type="primary"
                            class="copy-html-btn"
                            :data-clipboard-text="htmlCode"
                            @click="copyHtmlCode">
                            {{ i18nt("designer.hint.copyHtmlCode") }}
                        </el-button>
                        <el-button @click="saveVueCode">
                            {{ i18nt("designer.hint.saveVueCode") }}
                        </el-button>
                        <el-button @click="saveHtmlCode">
                            {{ i18nt("designer.hint.saveHtmlCode") }}
                        </el-button>
                        <el-button @click="showExportCodeDialogFlag = false">
                            {{ i18nt("designer.hint.closePreview") }}
                        </el-button>
                    </div>
                </template>
            </el-dialog>
        </div>

        <div
            v-if="showFormDataDialogFlag"
            v-drag="[
				'.nested-drag-dialog.el-dialog',
				'.nested-drag-dialog .el-dialog__header',
			]"
            class="">
            <el-dialog
                v-model="showFormDataDialogFlag"
                :title="i18nt('designer.hint.exportFormData')"
                :show-close="true"
                custom-class="nested-drag-dialog dialog-title-light-bg"
                center
                :close-on-click-modal="false"
                :close-on-press-escape="false"
                :destroy-on-close="true"
                :append-to-body="true">
                <div style="border: 1px solid #dcdfe6">
                    <code-editor
                        v-model="formDataJson"
                        :mode="'json'"
                        :readonly="true"></code-editor>
                </div>
                <template #footer>
                    <div class="dialog-footer">
                        <el-button
                            type="primary"
                            class="copy-form-data-json-btn"
                            :data-clipboard-text="formDataRawJson"
                            @click="copyFormDataJson">
                            {{ i18nt("designer.hint.copyFormData") }}
                        </el-button>
                        <el-button @click="saveFormData">
                            {{ i18nt("designer.hint.saveFormData") }}
                        </el-button>
                        <el-button @click="showFormDataDialogFlag = false">
                            {{ i18nt("designer.hint.closePreview") }}
                        </el-button>
                    </div>
                </template>
            </el-dialog>
        </div>

        <div
            v-if="showExportSFCDialogFlag"
            v-drag="['.drag-dialog.el-dialog', '.drag-dialog .el-dialog__header']"
            class="">
            <el-dialog
                v-if="showExportSFCDialogFlag"
                v-model="showExportSFCDialogFlag"
                :title="i18nt('designer.toolbar.generateSFC')"
                :show-close="true"
                custom-class="drag-dialog small-padding-dialog"
                center
                width="65%"
                :close-on-click-modal="false"
                :close-on-press-escape="false"
                :destroy-on-close="true">
                <el-tabs
                    v-model="activeSFCTab"
                    type="border-card"
                    class="no-box-shadow no-padding">
                    <el-tab-pane label="Vue2" name="vue2">
                        <code-editor
                            v-model="sfcCode"
                            :mode="'html'"
                            :readonly="true"
                            :user-worker="false"></code-editor>
                    </el-tab-pane>
                    <el-tab-pane label="Vue3" name="vue3">
                        <code-editor
                            v-model="sfcCodeV3"
                            :mode="'html'"
                            :readonly="true"
                            :user-worker="false"></code-editor>
                    </el-tab-pane>
                </el-tabs>
                <template #footer>
                    <div class="dialog-footer">
                        <el-button
                            type="primary"
                            class="copy-vue2-sfc-btn"
                            :data-clipboard-text="sfcCode"
                            @click="copyV2SFC">
                            {{ i18nt("designer.hint.copyVue2SFC") }}
                        </el-button>
                        <el-button
                            type="primary"
                            class="copy-vue3-sfc-btn"
                            :data-clipboard-text="sfcCodeV3"
                            @click="copyV3SFC">
                            {{ i18nt("designer.hint.copyVue3SFC") }}
                        </el-button>
                        <el-button @click="saveV2SFC">
                            {{ i18nt("designer.hint.saveVue2SFC") }}
                        </el-button>
                        <el-button @click="saveV3SFC">
                            {{ i18nt("designer.hint.saveVue3SFC") }}
                        </el-button>
                        <el-button @click="showExportSFCDialogFlag = false">
                            {{ i18nt("designer.hint.closePreview") }}
                        </el-button>
                    </div>
                </template>
            </el-dialog>
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
        addWindowResizeHandler
    } from "@/utils/util";
    import i18n from "@/utils/i18n";
    import { generateCode } from "@/utils/code-generator";
    import { genSFC } from "@/utils/sfc-generator";
    import loadBeautifier from "@/utils/beautifierLoader";
    import { saveAs } from "file-saver";
    import axios from "axios";
    import SvgIcon from "../../svg-icon/index";
    import {
        ArrowLeft,
        ArrowRight,
        Delete,
        Edit,
        Share
    } from "@element-plus/icons-vue";
    import { VARIANT_FORM_VERSION } from "@/utils/config";

    export default {
        name: "ToolbarPanel",
        components: {
            VFormRender,
            CodeEditor,
            Clipboard,
            SvgIcon
        },
        mixins: [i18n],
        // provide() {
        //     return {
        //         getFormConfig: () => this.formConfig,  /* 解决provide传递formConfig属性的响应式更新问题！！ */
        //         globalOptionData: this.optionData,
        //         getOptionData: () => this.optionData,
        //         globalModel: {
        //             formModel: this.formModel,
        //         }
        //     }
        // },
        emits: ["changeGateCheckAuthorized"],
        inject: ["getDesignerConfig"],
        props: {
            designer: Object,
            formConfig: Object
        },
        data() {
            return {
                gateCheckAuthorized: true,
                isHighlight: this.designer.getContainerDroppableHighlight(),
                designerConfig: this.getDesignerConfig(),
                switchDisplay: "PC",
                toolbarWidth: 420,
                showPreviewDialogFlag: false,
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
                }
            };
        },
        computed: {
            formJson() {
                return {
                    // widgetList: this.designer.widgetList,
                    // formConfig: this.designer.formConfig

                    widgetList: deepClone(this.designer.widgetList),
                    formConfig: deepClone(this.designer.formConfig)
                };
            },

            undoDisabled() {
                return !this.designer.undoEnabled();
            },

            redoDisabled() {
                return !this.designer.redoEnabled();
            },

            layoutType() {
                return this.designer.getLayoutType();
            },

            isContainerDroppableHighlight() {
                return this.designer.getContainerDroppableHighlight();
            }
        },
        watch: {
            "designer.widgetList": {
                deep: true,
                handler(val) {
                    //console.log('test-----', val)
                    //this.refreshNodeTree()
                }
            }
            // 'designer.formConfig': {
            //     deep: true,
            //     handler(val) {
            //         //
            //     }
            // },
        },
        mounted() {
            let maxTBWidth = this.designerConfig.toolbarMaxWidth || 420;
            let minTBWidth = this.designerConfig.toolbarMinWidth || 300;
            let newTBWidth = window.innerWidth - 260 - 300 - 320 - 80;
            this.toolbarWidth =
                newTBWidth >= maxTBWidth
                    ? maxTBWidth
                    : newTBWidth <= minTBWidth
                    ? minTBWidth
                    : newTBWidth;
            addWindowResizeHandler(() => {
                this.$nextTick(() => {
                    let newTBWidth2 = window.innerWidth - 260 - 300 - 320 - 80;
                    this.toolbarWidth =
                        newTBWidth2 >= maxTBWidth
                            ? maxTBWidth
                            : newTBWidth2 <= minTBWidth
                            ? minTBWidth
                            : newTBWidth2;
                });
            });
        },
        created() {
            //
        },
        methods: {
            containerDroppableHighlight() {
                this.designer.containerDroppableHighlight();
            },
            openVolcatorGate() {
                this.gateCheckAuthorized = true;
                this.designer.formConfig.gateCheckAuthorized = true;
                this.$emit('changeGateCheckAuthorizedEvent')
            },
            showToolButton(configName) {
                if (this.designerConfig[configName] === undefined) {
                    return true;
                }

                return !!this.designerConfig[configName];
            },

            buildTreeNodeOfWidget(widget, treeNode) {
                let curNode = {
                    id: widget.id,
                    label: widget.options.label || widget.type
                    //selectable: true,
                };
                treeNode.push(curNode);

                if (widget.category === undefined) {
                    return;
                }

                curNode.children = [];
                if (widget.type === "grid") {
                    widget.cols.map((col) => {
                        let colNode = {
                            id: col.id,
                            label: col.options.name || widget.type,
                            children: []
                        };
                        curNode.children.push(colNode);
                        col.widgetList.map((wChild) => {
                            this.buildTreeNodeOfWidget(wChild, colNode.children);
                        });
                    });
                } else if (widget.type === "table") {
                    //TODO: 需要考虑合并单元格！！
                    widget.rows.map((row) => {
                        let rowNode = {
                            id: row.id,
                            label: "table-row",
                            selectable: false,
                            children: []
                        };
                        curNode.children.push(rowNode);

                        row.cols.map((cell) => {
                            if (cell.merged) {
                                //跳过合并单元格！！
                                return;
                            }

                            let rowChildren = rowNode.children;
                            let cellNode = {
                                id: cell.id,
                                label: "table-cell",
                                children: []
                            };
                            rowChildren.push(cellNode);

                            cell.widgetList.map((wChild) => {
                                this.buildTreeNodeOfWidget(wChild, cellNode.children);
                            });
                        });
                    });
                } else if (widget.type === "tab") {
                    widget.tabs.map((tab) => {
                        let tabNode = {
                            id: tab.id,
                            label: tab.options.name || widget.type,
                            selectable: false,
                            children: []
                        };
                        curNode.children.push(tabNode);
                        tab.widgetList.map((wChild) => {
                            this.buildTreeNodeOfWidget(wChild, tabNode.children);
                        });
                    });
                } else if (widget.type === "sub-form") {
                    widget.widgetList.map((wChild) => {
                        this.buildTreeNodeOfWidget(wChild, curNode.children);
                    });
                } else if (widget.category === "container") {
                    //自定义容器
                    widget.widgetList.map((wChild) => {
                        this.buildTreeNodeOfWidget(wChild, curNode.children);
                    });
                } else if (widget.category === "layout") {
                    //自定义容器
                    widget.widgetList.map((wChild) => {
                        this.buildTreeNodeOfWidget(wChild, curNode.children);
                    });
                }
            },

            refreshNodeTree() {
                this.nodeTreeData.length = 0;
                this.designer.widgetList.forEach((wItem) => {
                    this.buildTreeNodeOfWidget(wItem, this.nodeTreeData);
                });
            },

            showNodeTreeDrawer() {
                this.refreshNodeTree();
                this.showNodeTreeDrawerFlag = true;
                this.$nextTick(() => {
                    if (this.designer.selectedId) {
                        //同步当前选中组件到节点树！！！
                        this.$refs.nodeTree.setCurrentKey(this.designer.selectedId);
                    }
                });
            },

            undoHistory() {
                this.designer.undoHistoryStep();
            },

            redoHistory() {
                this.designer.redoHistoryStep();
            },

            changeLayoutType(newType) {
                this.designer.changeLayoutType(newType);
            },

            clearFormWidget() {
                this.designer.clearDesigner();
            },

            previewForm() {
                this.showPreviewDialogFlag = true;
                this.designer.setPreviewOrRender(this.showPreviewDialogFlag)
            },

            closePreviewForm() {
                this.showPreviewDialogFlag = false;
                this.designer.setPreviewOrRender(this.showPreviewDialogFlag);
            },

            saveAsFile(fileContent, defaultFileName) {
                this.$prompt(
                    this.i18nt("designer.hint.fileNameForSave"),
                    this.i18nt("designer.hint.saveFileTitle"),
                    {
                        inputValue: defaultFileName,
                        closeOnClickModal: false,
                        inputPlaceholder: this.i18nt(
                            "designer.hint.fileNameInputPlaceholder"
                        )
                    }
                )
                    .then(({ value }) => {
                        if (!value) {
                            value = defaultFileName;
                        }

                        if (getQueryParam("vscode") == 1) {
                            this.vsSaveFile(value, fileContent);
                            return;
                        }

                        const fileBlob = new Blob([fileContent], {
                            type: "text/plain;charset=utf-8"
                        });
                        saveAs(fileBlob, value);
                    })
                    .catch(() => {
                        //
                    });
            },

            vsSaveFile(fileName, fileContent) {
                const msgObj = {
                    cmd: "writeFile",
                    data: {
                        fileName,
                        code: fileContent
                    }
                };
                window.parent.postMessage(msgObj, "*");
            },

            importJson() {
                this.importTemplate = JSON.stringify(
                    this.designer.getImportTemplate(),
                    null,
                    "  "
                );
                this.showImportJsonDialogFlag = true;
                this.designer.saveFormContentToStorage();
            },

            doJsonImport() {
                try {
                    let importObj = JSON.parse(this.importTemplate);
                    //console.log('test import', this.importTemplate)
                    if (!importObj || !importObj.formConfig) {
                        throw new Error(this.i18nt("designer.hint.invalidJsonFormat"));
                    }

                    let fJsonVer = importObj.formConfig.jsonVersion;
                    if (!fJsonVer || fJsonVer !== 3) {
                        throw new Error(this.i18nt("designer.hint.jsonVersionMismatch"));
                    }

                    this.designer.loadFormJson(importObj);

                    this.showImportJsonDialogFlag = false;
                    this.$message.success(this.i18nt("designer.hint.importJsonSuccess"));

                    this.designer.emitHistoryChange();

                    this.designer.emitEvent("form-json-imported", []);
                } catch (ex) {
                    this.$message.error(ex + "");
                }
            },

            exportJson() {
                let widgetList = deepClone(this.designer.widgetList);
                let formConfig = deepClone(this.designer.formConfig);
                this.jsonContent = JSON.stringify({ widgetList, formConfig }, null, "  ");
                this.jsonRawContent = JSON.stringify({ widgetList, formConfig });
                this.showExportJsonDialogFlag = true;
            },

            copyFormJson(e) {
                copyToClipboard(
                    this.jsonRawContent,
                    e,
                    this.$message,
                    this.i18nt("designer.hint.copyJsonSuccess"),
                    this.i18nt("designer.hint.copyJsonFail")
                );
            },

            saveFormJson() {
                this.saveAsFile(this.jsonContent, `vform${generateId()}.json`);
            },

            exportCode() {
                this.vueCode = generateCode(this.formJson);
                this.htmlCode = generateCode(this.formJson, "html");
                this.showExportCodeDialogFlag = true;
            },

            copyVueCode(e) {
                copyToClipboard(
                    this.vueCode,
                    e,
                    this.$message,
                    this.i18nt("designer.hint.copyVueCodeSuccess"),
                    this.i18nt("designer.hint.copyVueCodeFail")
                );
            },

            copyHtmlCode(e) {
                copyToClipboard(
                    this.htmlCode,
                    e,
                    this.$message,
                    this.i18nt("designer.hint.copyHtmlCodeSuccess"),
                    this.i18nt("designer.hint.copyHtmlCodeFail")
                );
            },

            saveVueCode() {
                this.saveAsFile(this.vueCode, `vform${generateId()}.vue`);
            },

            saveHtmlCode() {
                this.saveAsFile(this.htmlCode, `vform${generateId()}.html`);
            },

            generateSFC() {
                loadBeautifier((beautifier) => {
                    this.sfcCode = genSFC(
                        this.designer.formConfig,
                        this.designer.widgetList,
                        beautifier
                    );
                    this.sfcCodeV3 = genSFC(
                        this.designer.formConfig,
                        this.designer.widgetList,
                        beautifier,
                        true
                    );
                    this.showExportSFCDialogFlag = true;
                });
            },

            copyV2SFC(e) {
                copyToClipboard(
                    this.sfcCode,
                    e,
                    this.$message,
                    this.i18nt("designer.hint.copySFCSuccess"),
                    this.i18nt("designer.hint.copySFCFail")
                );
            },

            copyV3SFC(e) {
                copyToClipboard(
                    this.sfcCodeV3,
                    e,
                    this.$message,
                    this.i18nt("designer.hint.copySFCSuccess"),
                    this.i18nt("designer.hint.copySFCFail")
                );
            },

            saveV2SFC() {
                this.saveAsFile(this.sfcCode, `vformV2-${generateId()}.vue`);
            },

            saveV3SFC() {
                this.saveAsFile(this.sfcCodeV3, `vformV3-${generateId()}.vue`);
            },

            getFormData() {
                this.$refs["preForm"]
                    .getFormData()
                    .then((formData) => {
                        this.formDataJson = JSON.stringify(formData, null, "  ");
                        this.formDataRawJson = JSON.stringify(formData);

                        this.showFormDataDialogFlag = true;
                    })
                    .catch((error) => {
                        this.$message.error(error);
                    });
            },

            copyFormDataJson(e) {
                copyToClipboard(
                    this.formDataRawJson,
                    e,
                    this.$message,
                    this.i18nt("designer.hint.copyJsonSuccess"),
                    this.i18nt("designer.hint.copyJsonFail")
                );
            },

            saveFormData() {
                this.saveAsFile(this.htmlCode, `formData${generateId()}.json`);
            },

            resetForm() {
                this.$refs["preForm"].resetForm();
            },

            setFormDisabled() {
                this.$refs["preForm"].disableForm();
            },

            setFormEnabled() {
                this.$refs["preForm"].enableForm();
            },

            testLoadForm() {
                axios
                    .get(
                        "https://www.fastmock.site/mock/e9710039bb5f11262d1a0f2f0bbe08c8/vform3/getFS"
                    )
                    .then((res) => {
                        let newFormJson = res.data;
                        this.$refs.preForm.setFormJson(newFormJson);
                        // let newFormData = {'input30696': '668899'}
                        // this.$refs.preForm.setFormData(newFormData)

                        console.log("test", "aaaaaaaa");
                        this.$nextTick(() => {
                            let newFormData = { input30696: "668899" };
                            this.$refs.preForm.setFormData(newFormData);
                        });
                    })
                    .catch((err) => {
                        //
                    });
            },

            testSetFormJson() {
                let newFormJson = {
                    widgetList: [
                        {
                            type: "static-text",
                            icon: "static-text",
                            formItemFlag: false,
                            options: {
                                name: "statictext111193",
                                columnWidth: "200px",
                                hidden: false,
                                textContent: "多列表单",
                                customClass: [],
                                onCreated: "",
                                onMounted: "",
                                label: "static-text"
                            },
                            id: "statictext111193"
                        },
                        {
                            type: "divider",
                            icon: "divider",
                            formItemFlag: false,
                            options: {
                                name: "divider102346",
                                label: "",
                                columnWidth: "200px",
                                direction: "horizontal",
                                contentPosition: "center",
                                hidden: false,
                                customClass: [],
                                onCreated: "",
                                onMounted: ""
                            },
                            id: "divider102346"
                        },
                        {
                            type: "grid",
                            category: "container",
                            icon: "grid",
                            cols: [
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "input",
                                            icon: "text-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "input12931",
                                                label: "发件人姓名",
                                                labelAlign: "",
                                                type: "text",
                                                defaultValue: "",
                                                placeholder: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                readonly: false,
                                                disabled: false,
                                                hidden: false,
                                                clearable: true,
                                                showPassword: false,
                                                required: true,
                                                validation: "",
                                                validationHint: "",
                                                customClass: [],
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                minLength: null,
                                                maxLength: null,
                                                showWordLimit: false,
                                                prefixIcon: "",
                                                suffixIcon: "",
                                                appendButton: false,
                                                appendButtonDisabled: false,
                                                buttonIcon: "el-icon-search",
                                                onCreated: "",
                                                onMounted: "",
                                                onInput: "",
                                                onChange: "",
                                                onFocus: "",
                                                onBlur: "",
                                                onValidate: ""
                                            },
                                            id: "input12931"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol25469",
                                        hidden: false,
                                        span: 12,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: []
                                    },
                                    id: "grid-col-25469"
                                },
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "input",
                                            icon: "text-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "input23031",
                                                label: "发件人号码",
                                                labelAlign: "",
                                                type: "text",
                                                defaultValue: "",
                                                placeholder: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                readonly: false,
                                                disabled: false,
                                                hidden: false,
                                                clearable: true,
                                                showPassword: false,
                                                required: true,
                                                validation: "",
                                                validationHint: "",
                                                customClass: "",
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                minLength: null,
                                                maxLength: null,
                                                showWordLimit: false,
                                                prefixIcon: "",
                                                suffixIcon: "",
                                                appendButton: false,
                                                appendButtonDisabled: false,
                                                buttonIcon: "el-icon-search",
                                                onCreated: "",
                                                onMounted: "",
                                                onInput: "",
                                                onChange: "",
                                                onFocus: "",
                                                onBlur: "",
                                                onValidate: ""
                                            },
                                            id: "input23031"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol25125",
                                        hidden: false,
                                        span: 12,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-25125"
                                },
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "switch",
                                            icon: "switch-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "switch96070",
                                                label: "是否保密",
                                                labelAlign: "",
                                                defaultValue: true,
                                                columnWidth: "200px",
                                                labelWidth: null,
                                                labelHidden: false,
                                                disabled: false,
                                                hidden: false,
                                                customClass: "",
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                switchWidth: 40,
                                                activeText: "",
                                                inactiveText: "",
                                                activeColor: null,
                                                inactiveColor: null,
                                                onCreated: "",
                                                onMounted: "",
                                                onChange: "",
                                                onValidate: ""
                                            },
                                            id: "switch96070"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol44470",
                                        hidden: false,
                                        span: 24,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-44470"
                                },
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "textarea",
                                            icon: "textarea-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "textarea21654",
                                                label: "发件人地址",
                                                labelAlign: "",
                                                rows: 3,
                                                defaultValue: "",
                                                placeholder: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                readonly: false,
                                                disabled: false,
                                                hidden: false,
                                                required: true,
                                                validation: "",
                                                validationHint: "",
                                                customClass: "",
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                minLength: null,
                                                maxLength: null,
                                                showWordLimit: false,
                                                onCreated: "",
                                                onMounted: "",
                                                onInput: "",
                                                onChange: "",
                                                onFocus: "",
                                                onBlur: "",
                                                onValidate: ""
                                            },
                                            id: "textarea21654"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol98223",
                                        hidden: false,
                                        span: 24,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-98223"
                                }
                            ],
                            options: {
                                name: "grid35834",
                                hidden: false,
                                gutter: 12,
                                customClass: ""
                            },
                            id: "grid35834"
                        },
                        {
                            type: "divider",
                            icon: "divider",
                            formItemFlag: false,
                            options: {
                                name: "divider69240",
                                label: "",
                                columnWidth: "200px",
                                direction: "horizontal",
                                contentPosition: "center",
                                hidden: false,
                                customClass: "",
                                onCreated: "",
                                onMounted: ""
                            },
                            id: "divider69240"
                        },
                        {
                            type: "grid",
                            category: "container",
                            icon: "grid",
                            cols: [
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "input",
                                            icon: "text-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "input113152",
                                                label: "收件人姓名111",
                                                labelAlign: "",
                                                type: "text",
                                                defaultValue: "",
                                                placeholder: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                readonly: false,
                                                disabled: false,
                                                hidden: false,
                                                clearable: true,
                                                showPassword: false,
                                                required: true,
                                                validation: "",
                                                validationHint: "",
                                                customClass: [],
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                minLength: null,
                                                maxLength: null,
                                                showWordLimit: false,
                                                prefixIcon: "",
                                                suffixIcon: "",
                                                appendButton: false,
                                                appendButtonDisabled: false,
                                                buttonIcon: "el-icon-search",
                                                onCreated: "",
                                                onMounted: "",
                                                onInput: "",
                                                onChange: "",
                                                onFocus: "",
                                                onBlur: "",
                                                onValidate: ""
                                            },
                                            id: "input113152"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol47242",
                                        hidden: false,
                                        span: 12,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-47242"
                                },
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "input",
                                            icon: "text-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "input40240",
                                                label: "收件人号码",
                                                labelAlign: "",
                                                type: "text",
                                                defaultValue: "",
                                                placeholder: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                readonly: false,
                                                disabled: false,
                                                hidden: false,
                                                clearable: true,
                                                showPassword: false,
                                                required: true,
                                                validation: "",
                                                validationHint: "",
                                                customClass: "",
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                minLength: null,
                                                maxLength: null,
                                                showWordLimit: false,
                                                prefixIcon: "",
                                                suffixIcon: "",
                                                appendButton: false,
                                                appendButtonDisabled: false,
                                                buttonIcon: "el-icon-search",
                                                onCreated: "",
                                                onMounted: "",
                                                onInput: "",
                                                onChange: "",
                                                onFocus: "",
                                                onBlur: "",
                                                onValidate: ""
                                            },
                                            id: "input40240"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol27970",
                                        hidden: false,
                                        span: 12,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-27970"
                                },
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "checkbox",
                                            icon: "checkbox-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "checkbox63174",
                                                label: "接收时间段",
                                                labelAlign: "",
                                                defaultValue: [],
                                                columnWidth: "200px",
                                                size: "",
                                                displayStyle: "inline",
                                                buttonStyle: false,
                                                border: false,
                                                labelWidth: null,
                                                labelHidden: false,
                                                disabled: false,
                                                hidden: false,
                                                optionItems: [
                                                    {
                                                        label: "上午9:00 - 11:30",
                                                        value: 1
                                                    },
                                                    { label: "下午12:30 - 18:00", value: 2 },
                                                    {
                                                        label: "晚上18:00 - 21:00",
                                                        value: 3
                                                    }
                                                ],
                                                required: true,
                                                validation: "",
                                                validationHint: "",
                                                customClass: "",
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                onCreated: "",
                                                onMounted: "",
                                                onChange: "",
                                                onValidate: ""
                                            },
                                            id: "checkbox63174"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol74653",
                                        hidden: false,
                                        span: 24,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-74653"
                                },
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "input",
                                            icon: "text-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "input78584",
                                                label: "收件人地址",
                                                labelAlign: "",
                                                type: "text",
                                                defaultValue: "",
                                                placeholder: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                readonly: false,
                                                disabled: false,
                                                hidden: false,
                                                clearable: true,
                                                showPassword: false,
                                                required: true,
                                                validation: "",
                                                validationHint: "",
                                                customClass: "",
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                minLength: null,
                                                maxLength: null,
                                                showWordLimit: false,
                                                prefixIcon: "",
                                                suffixIcon: "",
                                                appendButton: false,
                                                appendButtonDisabled: false,
                                                buttonIcon: "el-icon-search",
                                                onCreated: "",
                                                onMounted: "",
                                                onInput: "",
                                                onChange: "",
                                                onFocus: "",
                                                onBlur: "",
                                                onValidate: ""
                                            },
                                            id: "input78584"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol63781",
                                        hidden: false,
                                        span: 24,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-63781"
                                }
                            ],
                            options: {
                                name: "grid114672",
                                hidden: false,
                                gutter: 12,
                                customClass: ""
                            },
                            id: "grid114672"
                        },
                        {
                            type: "divider",
                            icon: "divider",
                            formItemFlag: false,
                            options: {
                                name: "divider75887",
                                label: "",
                                columnWidth: "200px",
                                direction: "horizontal",
                                contentPosition: "center",
                                hidden: false,
                                customClass: [],
                                onCreated: "",
                                onMounted: ""
                            },
                            id: "divider75887"
                        },
                        {
                            type: "grid",
                            category: "container",
                            icon: "grid",
                            cols: [
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "time-range",
                                            icon: "time-range-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "timerange47503",
                                                label: "送货时间",
                                                labelAlign: "",
                                                defaultValue: null,
                                                startPlaceholder: "",
                                                endPlaceholder: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                readonly: false,
                                                disabled: false,
                                                hidden: false,
                                                clearable: true,
                                                editable: false,
                                                format: "HH:mm:ss",
                                                required: true,
                                                validation: "",
                                                validationHint: "",
                                                customClass: "",
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                onCreated: "",
                                                onMounted: "",
                                                onChange: "",
                                                onFocus: "",
                                                onBlur: "",
                                                onValidate: ""
                                            },
                                            id: "timerange47503"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol109912",
                                        hidden: false,
                                        span: 24,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-109912"
                                },
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "slider",
                                            icon: "slider-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "slider54714",
                                                label: "价格保护",
                                                labelAlign: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                disabled: false,
                                                hidden: false,
                                                required: false,
                                                validation: "",
                                                validationHint: "",
                                                customClass: [],
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                min: 0,
                                                max: 100,
                                                step: 10,
                                                range: false,
                                                height: null,
                                                onCreated: "",
                                                onMounted: "",
                                                onChange: "",
                                                onValidate: "",
                                                showStops: true
                                            },
                                            id: "slider54714"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol114653",
                                        hidden: false,
                                        span: 24,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-114653"
                                },
                                {
                                    type: "grid-col",
                                    category: "container",
                                    icon: "grid-col",
                                    internal: true,
                                    widgetList: [
                                        {
                                            type: "textarea",
                                            icon: "textarea-field",
                                            formItemFlag: true,
                                            options: {
                                                name: "textarea64794",
                                                label: "其他信息",
                                                labelAlign: "",
                                                rows: 3,
                                                defaultValue: "",
                                                placeholder: "",
                                                columnWidth: "200px",
                                                size: "",
                                                labelWidth: null,
                                                labelHidden: false,
                                                readonly: false,
                                                disabled: false,
                                                hidden: false,
                                                required: false,
                                                validation: "",
                                                validationHint: "",
                                                customClass: "",
                                                labelIconClass: null,
                                                labelIconPosition: "rear",
                                                labelTooltip: null,
                                                minLength: null,
                                                maxLength: null,
                                                showWordLimit: false,
                                                onCreated: "",
                                                onMounted: "",
                                                onInput: "",
                                                onChange: "",
                                                onFocus: "",
                                                onBlur: "",
                                                onValidate: ""
                                            },
                                            id: "textarea64794"
                                        }
                                    ],
                                    options: {
                                        name: "gridCol80867",
                                        hidden: false,
                                        span: 24,
                                        offset: 0,
                                        push: 0,
                                        pull: 0,
                                        responsive: false,
                                        md: 12,
                                        sm: 12,
                                        xs: 12,
                                        customClass: ""
                                    },
                                    id: "grid-col-80867"
                                }
                            ],
                            options: {
                                name: "grid28709",
                                hidden: false,
                                gutter: 12,
                                customClass: ""
                            },
                            id: "grid28709"
                        }
                    ],
                    formConfig: {
                        modelName: "formData",
                        refName: "vForm",
                        rulesName: "rules",
                        labelWidth: 150,
                        labelPosition: "left",
                        size: "",
                        labelAlign: "label-right-align",
                        cssCode: "",
                        customClass: [],
                        functions: "",
                        layoutType: "PC",
                        jsonVersion: 3,
                        onFormCreated: "",
                        onFormMounted: "",
                        onFormDataChange: "",
                        onFormValidate: ""
                    }
                };
                this.$refs.preForm.setFormJson(newFormJson);
                this.$nextTick(() => {
                    this.$refs.preForm.setFormData({ input12931: "asdf" });
                });
            },

            testSetFormData() {
                let testFD = {
                    input89263: "899668"
                };
                this.$refs.preForm.setFormData(testFD);
            },

            testReloadOptionData() {
                this.testOptionData["select001"].push({
                    label: "aaa",
                    value: 888
                });

                this.$refs.preForm.reloadOptionData();
            },

            handleFormChange(fieldName, newValue, oldValue, formModel) {
                /*
                    console.log('---formChange start---')
                    console.log('fieldName', fieldName)
                    console.log('newValue', newValue)
                    console.log('oldValue', oldValue)
                    console.log('formModel', formModel)
                    console.log('---formChange end---')
                    */

                console.log("formModel", formModel);
            },

            testOnAppendButtonClick(clickedWidget) {
                console.log("test", clickedWidget);
            },

            testOnButtonClick(button) {
                console.log("test", button);
            },

            onMyEmitTest(aaa) {
                console.log("-----", aaa);
            },

            findWidgetById(wId) {
                let foundW = null;
                traverseAllWidgets(this.designer.widgetList, (w) => {
                    if (w.id === wId) {
                        foundW = w;
                    }
                });

                return foundW;
            },

            onNodeTreeClick(nodeData, node, nodeEl) {
                //console.log('test', JSON.stringify(nodeData))

                if (nodeData.selectable !== undefined && !nodeData.selectable) {
                    this.$message.info(
                        this.i18nt("designer.hint.currentNodeCannotBeSelected")
                    );
                } else {
                    const selectedId = nodeData.id;
                    const foundW = this.findWidgetById(selectedId);
                    if (foundW) {
                        this.designer.setSelected(foundW);
                    }
                }
            }
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
