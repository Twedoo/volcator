<template>
    <div class="panel-container">
        <div>
            <div class="tw-flex tw-items-center tw-justify-center tw-mt-1 tw-h-12">
                <el-form-item class="tw-mt-3">
                    <el-radio-group
                        v-model="tabSwitchWidgetTools"
                        class="radio-group-custom">
                        <el-radio-button
                            class="el-radio-button--small"
                            label="Widgets"
                            @click="showElements(true, false)" />
                        <el-radio-button
                            class="el-radio-button--small"
                            label="Forms"
                            @click="showElements(false, true)" />
                    </el-radio-group>
                </el-form-item>
            </div>
        </div>
        <el-tabs
            ref="div"
            :active-name="activeTab"
            type="card"
            class="no-bottom-margin tw-mx-2"
            style="height: 100%; overflow: hidden">
            <el-tab-pane v-show="isDisplay" name="1">
                <el-scrollbar
                    class="setting-scrollbar tw-text-specify-light tw-mb-4 tw-text-base tw-rounded-md"
                    :style="{ height: scrollerHeight }">
                    <template
                        v-if="
							!!designer.selectedWidget && !designer.selectedWidget.category
						">
                        <el-form
                            :model="optionModel"
                            size="small"
                            label-position="left"
                            label-width="120px"
                            class="setting-form"
                            @submit.prevent>
                            <el-collapse
                                v-model="widgetActiveCollapseNames"
                                class="setting-collapse">
                                <el-collapse-item
                                    v-if="showCollapse(commonProps)"
                                    name="1"
                                    :title="i18nt('designer.setting.commonSetting')"
                                    class="tw-text-specify-light tw-mb-4 tw-text-base tw-rounded-md">
                                    <template
                                        v-for="(editorName, propName) in commonProps"
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-text-specify-light tw-mb-4 tw-text-base">
                                        <component
                                            :is="getPropEditor(propName, editorName)"
                                            v-if="hasPropEditor(propName, editorName)"
                                            :designer="designer"
                                            :selected-widget="selectedWidget"
                                            :option-model="optionModel"></component>
                                    </template>
                                </el-collapse-item>

                                <el-collapse-item
                                    v-if="showCollapse(advProps)"
                                    name="2"
                                    :title="i18nt('designer.setting.advancedSetting')"
                                    class="tw-text-specify-light tw-mb-4 tw-text-base tw-rounded-md">
                                    <template
                                        v-for="(editorName, propName) in advProps"
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-text-specify-light tw-mb-4 tw-text-base">
                                        <component
                                            :is="getPropEditor(propName, editorName)"
                                            v-if="hasPropEditor(propName, editorName)"
                                            :designer="designer"
                                            :selected-widget="selectedWidget"
                                            :option-model="optionModel"></component>
                                    </template>
                                </el-collapse-item>

                                <el-collapse-item
                                    v-if="showEventCollapse() && showCollapse(eventProps)"
                                    name="3"
                                    :title="i18nt('designer.setting.eventSetting')"
                                    class="tw-text-specify-light tw-mb-4 tw-text-base tw-rounded-md">
                                    <template
                                        v-for="(editorName, propName) in eventProps"
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-text-specify-light tw-mb-4 tw-text-base">
                                        <component
                                            :is="getPropEditor(propName, editorName)"
                                            v-if="hasPropEditor(propName, editorName)"
                                            :designer="designer"
                                            :selected-widget="selectedWidget"
                                            :option-model="optionModel"></component>
                                    </template>
                                </el-collapse-item>
                            </el-collapse>
                        </el-form>
                    </template>

                    <template
                        v-if="
							!!designer.selectedWidget && !!designer.selectedWidget.category
						">
                        <el-form
                            :model="optionModel"
                            size="small"
                            label-position="left"
                            label-width="120px"
                            class="setting-form"
                            @submit.prevent>
                            <el-collapse
                                v-model="widgetActiveCollapseNames"
                                class="setting-collapse">
                                <el-collapse-item
                                    v-if="showCollapse(commonProps)"
                                    name="1"
                                    :title="i18nt('designer.setting.commonSetting')"
                                    class="tw-text-specify-light tw-mb-4 tw-text-base tw-rounded-md">
                                    <template
                                        v-for="(editorName, propName) in commonProps"
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-text-specify-light tw-mb-4 tw-text-base">
                                        <component
                                            :is="getPropEditor(propName, editorName)"
                                            v-if="hasPropEditor(propName, editorName)"
                                            :designer="designer"
                                            :selected-widget="selectedWidget"
                                            :option-model="optionModel"></component>
                                    </template>
                                </el-collapse-item>

                                <el-collapse-item
                                    v-if="showCollapse(advProps)"
                                    name="2"
                                    :title="i18nt('designer.setting.advancedSetting')"
                                    class="tw-text-specify-light tw-mb-4 tw-text-base tw-rounded-md">
                                    <template
                                        v-for="(editorName, propName) in advProps"
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-text-specify-light tw-mb-4 tw-text-base">
                                        <component
                                            :is="getPropEditor(propName, editorName)"
                                            v-if="hasPropEditor(propName, editorName)"
                                            :designer="designer"
                                            :selected-widget="selectedWidget"
                                            :option-model="optionModel"></component>
                                    </template>
                                </el-collapse-item>

                                <el-collapse-item
                                    v-if="showEventCollapse() && showCollapse(eventProps)"
                                    name="3"
                                    :title="i18nt('designer.setting.eventSetting')"
                                    class="tw-text-specify-light tw-mb-4 tw-text-base tw-rounded-md">
                                    <template
                                        v-for="(editorName, propName) in eventProps"
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-text-specify-light tw-mb-4 tw-text-base">
                                        <component
                                            :is="getPropEditor(propName, editorName)"
                                            v-if="hasPropEditor(propName, editorName)"
                                            :designer="designer"
                                            :selected-widget="selectedWidget"
                                            :option-model="optionModel"></component>
                                    </template>
                                </el-collapse-item>
                            </el-collapse>
                        </el-form>
                    </template>
                </el-scrollbar>
            </el-tab-pane>
            <el-tab-pane v-show="isDisplayElement" name="2">
                <el-scrollbar
                    class="setting-scrollbar tw-text-specify-light tw-mb-4 tw-text-base tw-rounded-md"
                    :style="{ height: scrollerHeight }">
                    <form-setting
                        :designer="designer"
                        :form-config="formConfig"></form-setting>
                </el-scrollbar>
            </el-tab-pane>
        </el-tabs>

        <div
            v-if="showWidgetEventDialogFlag"
            v-drag="['.drag-dialog.el-dialog', '.drag-dialog .el-dialog__header']"
            class="">
            <el-dialog
                v-model="showWidgetEventDialogFlag"
                :title="i18nt('designer.setting.editWidgetEventHandler')"
                :show-close="true"
                custom-class="drag-dialog small-padding-dialog"
                :close-on-click-modal="false"
                :close-on-press-escape="false"
                :destroy-on-close="true">
                <el-alert type="info" :closable="false" :title="eventHeader"></el-alert>
                <code-editor
                    ref="ecEditor"
                    v-model="eventHandlerCode"
                    :mode="'javascript'"
                    :readonly="false"></code-editor>
                <el-alert type="info" :closable="false" title="}"></el-alert>
                <template #footer>
                    <div class="dialog-footer">
                        <el-button @click="showWidgetEventDialogFlag = false">
                            {{ i18nt("designer.hint.cancel") }}
                        </el-button>
                        <el-button type="primary" @click="saveEventHandler">
                            {{ i18nt("designer.hint.confirm") }}
                        </el-button>
                    </div>
                </template>
            </el-dialog>
        </div>
    </div>
</template>

<script>
import CodeEditor from "@/components/code-editor/index";
import PropertyEditors from "./property-editor/index";
import TailwindEditors from "./tailwind-editor/index";
import FormSetting from "./form-setting";
import WidgetProperties from "./propertyRegister";
import { addWindowResizeHandler } from "@/utils/util";
import i18n from "@/utils/i18n";
import eventBus from "@/utils/event-bus";
import emitter from "@/utils/emitter";
import { propertyRegistered } from "@/components/form-designer/setting-panel/propertyRegister";

const { COMMON_PROPERTIES, ADVANCED_PROPERTIES, EVENT_PROPERTIES } =
    WidgetProperties;

export default {
    name: "SettingPanel",
    componentName: "SettingPanel",
    components: {
        CodeEditor,
        FormSetting,
        ...PropertyEditors,
        ...TailwindEditors
    },
    mixins: [i18n, emitter],
    inject: ["getDesignerConfig"],
    props: {
        designer: Object,
        selectedWidget: Object,
        formConfig: Object
    },
    data() {
        return {
            tabSwitchWidgetTools: "Forms",
            isDisplay: false,
            isDisplayElement: true,
            designerConfig: this.getDesignerConfig(),

            scrollerHeight: 0,

            activeTab: "2",
            widgetActiveCollapseNames: ["1", "3"], //['1', '2', '3'],
            formActiveCollapseNames: ["1", "2"],

            commonProps: COMMON_PROPERTIES,
            advProps: ADVANCED_PROPERTIES,
            eventProps: EVENT_PROPERTIES,

            showWidgetEventDialogFlag: false,
            eventHandlerCode: "",
            curEventName: "",
            eventHeader: "",

            subFormChildWidgetFlag: false
        };
    },
    computed: {
        optionModel: {
            get() {
                console.log("selectedWidget panel options : ", this.selectedWidget.options);
                console.log("designer panel options : ", this.designer);
                console.log("formConfig panel options : ", this.formConfig);
                return this.selectedWidget.options;
            },

            set(newValue) {
                this.selectedWidget.options = newValue;
            }
        }
    },
    watch: {
        "designer.selectedWidget": {
            handler(val) {
                if (val) {
                    this.activeTab = "1";
                    this.tabSwitchWidgetTools = "Widgets";
                }
            }
        },

        "selectedWidget.options": {
            //组件属性变动后，立即保存表单JSON！！
            deep: true,
            handler() {
                this.designer.saveCurrentHistoryStep();
            }
        },

        formConfig: {
            deep: true,
            handler() {
                this.designer.saveCurrentHistoryStep();
            }
        }
    },
    created() {
        this.on$("editEventHandler", (eventParams) => {
            //debugger
            this.editEventHandler(eventParams[0], eventParams[1]);
        });

        this.designer.handleEvent("form-css-updated", (cssClassList) => {
            this.designer.setCssClassList(cssClassList);
        });
    },
    mounted() {
        if (!this.designer.selectedWidget) {
            this.activeTab = "2";
        } else {
            this.activeTab = "1";
        }

        this.scrollerHeight = window.innerHeight - 56 - 48 + "px";
        addWindowResizeHandler(() => {
            this.$nextTick(() => {
                this.scrollerHeight = window.innerHeight - 56 - 48 + "px";
                //console.log(this.scrollerHeight)
            });
        });
    },
    methods: {
        showElements: function(isDisplay, isDisplayElement) {
            this.isDisplay = isDisplay;
            this.isDisplayElement = isDisplayElement;
        },

        showEventCollapse() {
            if (this.designerConfig["eventCollapse"] === undefined) {
                return true;
            }

            return !!this.designerConfig["eventCollapse"];
        },

        hasPropEditor(propName, editorName) {
            if (!editorName) {
                return false;
            }

            /* alert组件注册了两个type属性编辑器，跳过第一个type属性编辑器，只显示第二个alert-type属性编辑器！！ */
            if (propName.indexOf("-") <= -1) {
                let uniquePropName = this.selectedWidget.type + "-" + propName;
                if (propertyRegistered(uniquePropName)) {
                    return false;
                }
            }

            let originalPropName = propName.replace(
                this.selectedWidget.type + "-",
                ""
            ); //去掉组件名称前缀-，如果有的话！！
            return this.designer.hasConfig(this.selectedWidget, originalPropName);
        },

        getPropEditor(propName, editorName) {
            let originalPropName = propName.replace(
                this.selectedWidget.type + "-",
                ""
            ); //去掉组件名称前缀-，如果有的话！！
            let ownPropEditorName = `${this.selectedWidget.type}-${originalPropName}-editor`;
            //console.log(ownPropEditorName, this.$options.components[ownPropEditorName])
            if (this.$options.components[ownPropEditorName]) {
                //局部注册的属性编辑器组件
                return ownPropEditorName;
            }

            //return !!this.$root.$options.components[ownPropEditorName] ? ownPropEditorName : editorName  //Vue2全局注册的属性编辑器组件
            return this.$root.$.appContext.components[ownPropEditorName]
                ? ownPropEditorName
                : editorName; //Vue3全局注册的属性编辑器组件
        },

        showCollapse(propsObj) {
            let result = false;
            this.isDisplay = true;
            this.isDisplayElement = false;
            for (let propName in propsObj) {
                if (!propsObj.hasOwnProperty(propName)) {
                    continue;
                }

                if (this.hasPropEditor(propName, propsObj[propName])) {
                    result = true;
                    break;
                }
            }

            return result;
        },

        editEventHandler(eventName, eventParams) {
            //debugger

            this.curEventName = eventName;
            this.eventHeader = `${
                this.optionModel.name
            }.${eventName}(${eventParams.join(", ")}) {`;
            this.eventHandlerCode = this.selectedWidget.options[eventName] || "";

            // 设置字段校验函数示例代码
            if (eventName === "onValidate" && !this.optionModel["onValidate"]) {
                this.eventHandlerCode =
                    "  /* sample code */\n  /*\n  if ((value > 100) || (value < 0)) {\n    callback(new Error('error message'))  //fail\n  } else {\n    callback();  //pass\n  }\n  */";
            }

            this.showWidgetEventDialogFlag = true;
        },

        saveEventHandler() {
            const codeHints = this.$refs.ecEditor.getEditorAnnotations();
            let syntaxErrorFlag = false;
            if (!!codeHints && codeHints.length > 0) {
                codeHints.forEach((chItem) => {
                    if (chItem.type === "error") {
                        syntaxErrorFlag = true;
                    }
                });

                if (syntaxErrorFlag) {
                    this.$message.error(
                        this.i18nt("designer.setting.syntaxCheckWarning")
                    );
                    return;
                }
            }

            this.selectedWidget.options[this.curEventName] = this.eventHandlerCode;
            this.showWidgetEventDialogFlag = false;
        }
    }
};
</script>

<style lang="scss" scoped>
.setting-scrollbar {
    :deep(.el-scrollbar__wrap) {
        overflow-x: hidden;
    }

    :deep(.el-scrollbar__view) {
        margin-top: 3px;
    }
}

.setting-collapse {
    :deep(.el-collapse-item__content) {
        padding-bottom: 6px;
        padding-left: 12px;
    }
}

.setting-form {
    :deep(.el-form-item__label) {
        font-size: 13px;
        overflow: hidden;
        white-space: nowrap;
    }

    :deep(.el-form-item--small.el-form-item) {
        margin-bottom: 10px;
    }
}

:deep(.hide-spin-button) input::-webkit-outer-spin-button,
:deep(.hide-spin-button) input::-webkit-inner-spin-button {
    -webkit-appearance: none !important;
}

:deep(.hide-spin-button) input[type='number'] {
    -moz-appearance: textfield;
}

:deep(.custom-divider.el-divider--horizontal) {
    margin: 10px 0;
}

:deep(.custom-divider-margin-top.el-divider--horizontal) {
    margin: 20px 0;
}

.small-padding-dialog {
    :deep(.el-dialog__body) {
        padding: 6px 15px 12px 15px;
    }
}

.el-collapse-item {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    box-shadow: 0px 0px 7px -2px rgba(0, 0, 0, 0.1);

    :deep(.el-collapse-item__wrap) {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    :deep(.el-collapse-item__header) {
        border-radius: 10px;
        box-shadow: 0px 0px 7px -2px rgba(0, 0, 0, 0.1);
        font-weight: bold;
        color: #7575a3;
        padding-left: 12px;
    }

    :deep(.el-collapse-item__header.is-active) {
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
}

.el-collapse-item :deep(ul) > li {
    list-style: none;
    font-weight: bold;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    border: 1px solid #232135;
}

.ft-card {
    margin-bottom: 10px;

    .bottom {
        margin-top: 10px;
        line-height: 12px;
    }

    .ft-title {
        font-size: 13px;
        font-weight: bold;
    }

    .right-button {
        padding: 0;
        float: right;
    }

    .clear-fix:before,
    .clear-fix:after {
        display: table;
        content: '';
    }

    .clear-fix:after {
        clear: both;
    }
}
</style>
