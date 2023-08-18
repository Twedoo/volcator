<template>
    <el-scrollbar class="side-scroll-bar" :style="{ height: scrollerHeight }">
        <div class="panel-container">
            <div class="tw-flex tw-items-center tw-justify-center tw-mt-1 tw-h-12">
                <el-form :model="formConfig">
                    <el-form-item class="tw-mt-3">
                        <el-radio-group v-model="tabSwitchTools" class="radio-group-custom">
                            <el-radio-button
                                class="el-radio-button--small"
                                label="Elements"
                                @click="showElements('Elements')" />
                            <el-radio-button
                                class="el-radio-button--small"
                                label="UI Components"
                                @click="showElements('Components')" />
                            <el-radio-button
                                class="el-radio-button--small"
                                label="Templates"
                                @click="showElements('Templates')" />
                        </el-radio-group>
                    </el-form-item>
                </el-form>
            </div>
            <el-tabs
                ref="div"
                v-model="firstTab"
                type="card"
                class="no-bottom-margin tw-mx-2">
                <el-tab-pane name="componentLib">
                    <el-collapse
                        v-show="isDisplayElement === 'Elements'"
                        v-model="activeNames"
                        class="widget-collapse">

                        <el-collapse-item
                            class="tw-text-specify-light tw-mb-4 tw-text-base"
                            name="1"
                            :title="i18nt('designer.layoutsTitle')">
                            <draggable
                                tag="ul"
                                :list="layouts"
                                item-key="key"
                                :group="{ name: 'dragGroup', pull: 'clone', put: false }"
                                :clone="handleContainerWidgetClone"
                                ghost-class="ghost"
                                :sort="false"
                                :move="checkContainerMove"
                                @end="onContainerDragEnd">
                                <template #item="{ element: ctn }">
                                    <div
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-cursor-grabbing"
                                        :title="ctn.displayName"
                                        @dblclick="addContainerByDbClick(ctn)">
                                        <div
                                            class="tw-flex tw-justify-start tw-items-center tw-px-2 h-16 tw-rounded-md tw-bg-background-primary">
                                            <svg-icon
                                                :icon-class="ctn.icon"
                                                class-name="color-svg-icon tw-text-xl tw-text-specify-light" />
                                            <div class="tw-mx-2 tw-my-1">
                                                <h2
                                                    class="tw-text-base tw-font-bold tw-text-specify-light">
                                                    {{
                                                        i18n2t(
                                                            `designer.widgetLabel.${ctn.type}`,
                                                            `extension.widgetLabel.${ctn.type}`
                                                        )
                                                    }}
                                                </h2>
                                                <span class="tw-text-sm tw-text-specify-light">
													description
												</span>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </draggable>
                        </el-collapse-item>

                        <el-collapse-item
                            class="tw-text-specify-light tw-mb-4 tw-text-base"
                            name="2"
                            :title="i18nt('designer.containerTitle')">
                            <draggable
                                tag="ul"
                                :list="containers"
                                item-key="key"
                                :group="{ name: 'dragGroup', pull: 'clone', put: false }"
                                :clone="handleContainerWidgetClone"
                                ghost-class="ghost"
                                :sort="false"
                                :move="checkContainerMove"
                                @end="onContainerDragEnd">
                                <template #item="{ element: ctn }">
                                    <div
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-cursor-grabbing"
                                        :title="ctn.displayName"
                                        @dblclick="addContainerByDbClick(ctn)">
                                        <div
                                            class="tw-flex tw-justify-start tw-items-center tw-px-2 h-16 tw-rounded-md tw-bg-background-primary">
                                            <svg-icon
                                                :icon-class="ctn.icon"
                                                class-name="color-svg-icon tw-text-xl tw-text-specify-light" />
                                            <div class="tw-mx-2 tw-my-1">
                                                <h2
                                                    class="tw-text-base tw-font-bold tw-text-specify-light">
                                                    {{
                                                        i18n2t(
                                                            `designer.widgetLabel.${ctn.type}`,
                                                            `extension.widgetLabel.${ctn.type}`
                                                        )
                                                    }}
                                                </h2>
                                                <span class="tw-text-sm tw-text-specify-light">
													description
												</span>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </draggable>
                        </el-collapse-item>

                        <el-collapse-item
                            name="3"
                            class="tw-text-specify-light tw-my-4 tw-text-base"
                            :title="i18nt('designer.basicFieldTitle')">
                            <draggable
                                tag="ul"
                                :list="basicFields"
                                item-key="key"
                                :group="{ name: 'dragGroup', pull: 'clone', put: false }"
                                :move="checkFieldMove"
                                :clone="handleFieldWidgetClone"
                                ghost-class="ghost"
                                :sort="false">
                                <template #item="{ element: fld }">
                                    <div
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-cursor-grabbing"
                                        :title="fld.displayName"
                                        @dblclick="addFieldByDbClick(fld)">
                                        <div
                                            class="tw-flex tw-justify-start tw-items-center tw-px-2 h-16 tw-rounded-md tw-bg-background-primary">
                                            <svg-icon
                                                :icon-class="fld.icon"
                                                class-name="color-svg-icon tw-text-xl tw-text-specify-light" />
                                            <div class="tw-mx-2 tw-my-1">
                                                <h2
                                                    class="tw-text-base tw-font-bold tw-text-specify-light">
                                                    {{
                                                        i18n2t(
                                                            `designer.widgetLabel.${fld.type}`,
                                                            `extension.widgetLabel.${fld.type}`
                                                        )
                                                    }}
                                                </h2>
                                                <span class="tw-text-sm tw-text-specify-light">
													description
												</span>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </draggable>
                        </el-collapse-item>

                        <el-collapse-item
                            name="4"
                            class="tw-text-specify-light tw-my-4 tw-text-base"
                            :title="i18nt('designer.advancedFieldTitle')">
                            <draggable
                                tag="ul"
                                :list="advancedFields"
                                item-key="key"
                                :group="{ name: 'dragGroup', pull: 'clone', put: false }"
                                :move="checkFieldMove"
                                :clone="handleFieldWidgetClone"
                                ghost-class="ghost"
                                :sort="false">
                                <template #item="{ element: fld }">
                                    <div
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-cursor-grabbing"
                                        :title="fld.displayName"
                                        @dblclick="addFieldByDbClick(fld)">
                                        <div
                                            class="tw-flex tw-justify-start tw-items-center tw-px-2 h-16 tw-rounded-md tw-bg-background-primary">
                                            <svg-icon
                                                :icon-class="fld.icon"
                                                class-name="color-svg-icon tw-text-xl tw-text-specify-light" />
                                            <div class="tw-mx-2 tw-my-1">
                                                <h2
                                                    class="tw-text-base tw-font-bold tw-text-specify-light">
                                                    {{
                                                        i18n2t(
                                                            `designer.widgetLabel.${fld.type}`,
                                                            `extension.widgetLabel.${fld.type}`
                                                        )
                                                    }}
                                                </h2>
                                                <span class="tw-text-sm tw-text-specify-light">
													description
												</span>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </draggable>
                        </el-collapse-item>

                        <el-collapse-item
                            name="5"
                            class="tw-text-specify-light tw-my-4 tw-text-base"
                            :title="i18nt('designer.customFieldTitle')">
                            <draggable
                                tag="ul"
                                :list="customFields"
                                item-key="key"
                                :group="{ name: 'dragGroup', pull: 'clone', put: false }"
                                :move="checkFieldMove"
                                :clone="handleFieldWidgetClone"
                                ghost-class="ghost"
                                :sort="false">
                                <template #item="{ element: fld }">
                                    <div
                                        class="tw-pr-3 tw-py-3 w-h-16 tw-cursor-grabbing"
                                        :title="fld.displayName"
                                        @dblclick="addFieldByDbClick(fld)">
                                        <div
                                            class="tw-flex tw-justify-start tw-items-center tw-px-2 h-16 tw-rounded-md tw-bg-background-primary">
                                            <svg-icon
                                                :icon-class="fld.icon"
                                                class-name="color-svg-icon tw-text-xl tw-text-specify-light" />

                                            <div class="tw-mx-2 tw-my-1">
                                                <h2
                                                    class="tw-text-base tw-font-bold tw-text-specify-light">
                                                    {{
                                                        i18n2t(
                                                            `designer.widgetLabel.${fld.type}`,
                                                            `extension.widgetLabel.${fld.type}`
                                                        )
                                                    }}
                                                </h2>
                                                <span class="tw-text-sm tw-text-specify-light">
													description
												</span>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </draggable>
                        </el-collapse-item>
                    </el-collapse>
                </el-tab-pane>
                <el-tab-pane v-show="isDisplayElement === 'Templates'" name="formLib">
                    <template v-for="(ft, idx) in formTemplates">
                        <el-card
                            :bord-style="{ padding: '0' }"
                            shadow="hover"
                            class="ft-card">
                            <el-popover placement="right" trigger="hover">
                                <template #reference>
                                    <img :src="ft.imgUrl" style="width: 200px" />
                                </template>
                                <img :src="ft.imgUrl" style="height: 600px; width: 720px" />
                            </el-popover>
                            <div class="bottom clear-fix">
                                <span class="ft-title">#{{ idx + 1 }} {{ ft.title }}</span>
                                <el-button
                                    type="text"
                                    class="right-button"
                                    @click="loadFormTemplate(ft.jsonUrl)">
                                    {{ i18nt("designer.hint.loadFormTemplate") }}
                                </el-button>
                            </div>
                        </el-card>
                    </template>
                </el-tab-pane>
            </el-tabs>
        </div>
    </el-scrollbar>
</template>

<script>
import {
    layouts as LYS,
    containers as CONS,
    basicFields as BFS,
    advancedFields as AFS,
    customFields as CFS
} from "./widgetsConfig";
import { formTemplates } from "./templatesConfig";
import { addWindowResizeHandler, generateId } from "@/utils/util";
import i18n from "@/utils/i18n";
import axios from "axios";
import SvgIcon from "@/components/svg-icon/index";
import { ref } from "vue";
// import ftImg1 from '@/assets/ft-images/t1.png'
// import ftImg2 from '@/assets/ft-images/t2.png'
// import ftImg3 from '@/assets/ft-images/t3.png'
// import ftImg4 from '@/assets/ft-images/t4.png'
// import ftImg5 from '@/assets/ft-images/t5.png'
// import ftImg6 from '@/assets/ft-images/t6.png'
// import ftImg7 from '@/assets/ft-images/t7.png'
// import ftImg8 from '@/assets/ft-images/t8.png'

export default {
    name: "FieldPanel",
    components: {
        SvgIcon
    },
    mixins: [i18n],
    inject: ["getBannedWidgets", "getDesignerConfig"],
    props: {
        designer: Object,
        formConfig: Object
    },
    data() {
        return {
            tabSwitchTools: "UI Components",
            isDisplayElement: false,

            designerConfig: this.getDesignerConfig(),

            firstTab: "componentLib",

            scrollerHeight: 0,

            activeNames: ["1", "2", "3", "4"],

            containers: [],
            layouts: [],
            basicFields: [],
            advancedFields: [],
            customFields: [],

            formTemplates: formTemplates
            // ftImages: [
            //   {imgUrl: ftImg1},
            //   {imgUrl: ftImg2},
            //   {imgUrl: ftImg3},
            //   {imgUrl: ftImg4},
            //   {imgUrl: ftImg5},
            //   {imgUrl: ftImg6},
            //   {imgUrl: ftImg7},
            //   {imgUrl: ftImg8},
            // ]
        };
    },
    computed: {
        //
    },
    created() {
        this.loadWidgets();
        this.designer.handleEvent("form-json-imported", () => {
            this.formCssCode = this.formConfig.cssCode;
            insertCustomCssToHead(this.formCssCode);
            this.extractCssClass();
            this.designer.emitEvent("form-css-updated", deepClone(this.cssClassList));
        });
    },
    mounted() {
        //this.loadWidgets()

        this.scrollerHeight = window.innerHeight - 56 + "px";
        addWindowResizeHandler(() => {
            this.$nextTick(() => {
                this.scrollerHeight = window.innerHeight - 56 + "px";
                //console.log(this.scrollerHeight)
            });
        });
    },
    methods: {
        isBanned(wName) {
            return this.getBannedWidgets().indexOf(wName) > -1;
        },
        hideElements: function() {
            this.$refs.div.style.display = "none";
        },
        showElements: function(displayElement) {
            this.isDisplayElement = displayElement;
        },
        showFormTemplates() {
            if (this.designerConfig["formTemplates"] === undefined) {
                return true;
            }

            return !!this.designerConfig["formTemplates"];
        },

        loadWidgets() {
            this.layouts = LYS.map((lys) => {
                return {
                    key: generateId(),
                    ...lys,
                    displayName: this.i18n2t(
                        `designer.widgetLabel.${lys.type}`,
                        `extension.widgetLabel.${lys.type}`
                    )
                };
            }).filter((lys) => {
                return !lys.internal && !this.isBanned(lys.type);
            });

            this.containers = CONS.map((con) => {
                return {
                    key: generateId(),
                    ...con,
                    displayName: this.i18n2t(
                        `designer.widgetLabel.${con.type}`,
                        `extension.widgetLabel.${con.type}`
                    )
                };
            }).filter((con) => {
                return !con.internal && !this.isBanned(con.type);
            });

            this.basicFields = BFS.map((fld) => {
                return {
                    key: generateId(),
                    ...fld,
                    displayName: this.i18n2t(
                        `designer.widgetLabel.${fld.type}`,
                        `extension.widgetLabel.${fld.type}`
                    )
                };
            }).filter((fld) => {
                return !this.isBanned(fld.type);
            });

            this.advancedFields = AFS.map((fld) => {
                return {
                    key: generateId(),
                    ...fld,
                    displayName: this.i18n2t(
                        `designer.widgetLabel.${fld.type}`,
                        `extension.widgetLabel.${fld.type}`
                    )
                };
            }).filter((fld) => {
                return !this.isBanned(fld.type);
            });

            this.customFields = CFS.map((fld) => {
                return {
                    key: generateId(),
                    ...fld,
                    displayName: this.i18n2t(
                        `designer.widgetLabel.${fld.type}`,
                        `extension.widgetLabel.${fld.type}`
                    )
                };
            }).filter((fld) => {
                return !this.isBanned(fld.type);
            });
        },

        handleContainerWidgetClone(origin) {
            return this.designer.copyNewContainerWidget(origin);
        },

        handleFieldWidgetClone(origin) {
            return this.designer.copyNewFieldWidget(origin);
        },

        checkContainerMove(evt) {
            return this.designer.checkWidgetMove(evt);
        },

        checkFieldMove(evt) {
            return this.designer.checkFieldMove(evt);
        },

        onContainerDragEnd(evt) {
            //console.log('Drag end of container: ')
            //console.log(evt)
        },

        addContainerByDbClick(container) {
            this.designer.addContainerByDbClick(container);
        },

        addFieldByDbClick(widget) {
            this.designer.addFieldByDbClick(widget);
        },

        loadFormTemplate(jsonUrl) {
            this.$confirm(
                this.i18nt("designer.hint.loadFormTemplateHint"),
                this.i18nt("render.hint.prompt"),
                {
                    confirmButtonText: this.i18nt("render.hint.confirm"),
                    cancelButtonText: this.i18nt("render.hint.cancel")
                }
            )
                .then(() => {
                    axios
                        .get(jsonUrl)
                        .then((res) => {
                            let modifiedFlag = false;
                            if (typeof res.data === "string") {
                                modifiedFlag = this.designer.loadFormJson(JSON.parse(res.data));
                            } else if (res.data.constructor === Object) {
                                modifiedFlag = this.designer.loadFormJson(res.data);
                            }
                            if (modifiedFlag) {
                                this.designer.emitHistoryChange();
                            }

                            this.$message.success(
                                this.i18nt("designer.hint.loadFormTemplateSuccess")
                            );
                        })
                        .catch((error) => {
                            this.$message.error(
                                this.i18nt("designer.hint.loadFormTemplateFailed") + ":" + error
                            );
                        });
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
.el-radio-button.el-radio {
    background-color: rgb(222, 233, 243);
    border-color: #409eff;
}

.setting-form {
    :deep(.el-form-item__label) {
        font-size: 13px;
        //text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    :deep(.el-form-item--small.el-form-item) {
        margin-bottom: 10px;
    }

    .radio-group-custom {
        :deep(.el-radio-button__inner) {
            padding-left: 12px;
            padding-right: 12px;
        }
    }

    .custom-divider.el-divider--horizontal {
        margin: 10px 0;
    }
}

.setting-collapse {
    :deep(.el-collapse-item__content) {
        padding-bottom: 6px;
    }

    :deep(.el-collapse-item__header) {
        font-style: italic;
        font-weight: bold;
    }
}

.small-padding-dialog {
    :deep(.el-dialog__body) {
        padding: 6px 15px 12px 15px;
    }
}

.el-tabs--card > .el-tabs__header .el-tabs__item.is-active {
    background: #232135;
}

.color-svg-icon {
    color: $--color-primary;
}

.side-scroll-bar {
    :deep(.el-scrollbar__wrap) {
        overflow-x: hidden;
    }
}

div.panel-container {
    padding-bottom: 10px;
}

.no-bottom-margin :deep(.el-tabs__header) {
    margin-bottom: 0;
}

.el-collapse-item {
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    box-shadow: 0px 0px 7px -2px rgba(0, 0, 0, 0.1);

    :deep(.el-collapse-item__wrap) {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
}

.el-collapse-item :deep(ul) > li {
    list-style: none;
    font-weight: bold;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
    border: 1px solid #232135;
}

.widget-collapse {
    border-top-width: 0;
    border-radius: 15px;
    margin: 4px;

    :deep(.el-collapse-item__header) {
        font-weight: bold;
        color: #7575a3;
        border-radius: 10px;
        padding-left: 12px;
    }

    :deep(.el-collapse-item__header.is-active) {
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    :deep(.el-collapse-item__content) {
        padding-bottom: 0 !important;

        ul {
            margin: 0;
            margin-block-start: 0;
            margin-block-end: 0.25em;
            padding-inline-start: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            position: relative;

            &:after {
                content: '';
                display: block;
                clear: both;
            }

            .container-widget-item,
            .field-widget-item {
                display: inline-block;
                height: 28px;
                line-height: 28px;
                width: 115px;
                float: left;
                margin: 2px 6px 6px 0;
                cursor: move;
                white-space: nowrap;
                text-overflow: ellipsis;
                overflow: hidden;
                background: #f1f2f3;
            }

            .container-widget-item:hover,
            .field-widget-item:hover {
                background: #7575a3;
                outline: 1px solid $--color-primary;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
            }

            .drag-handler {
                position: absolute;
                top: 0;
                left: 160px;
                background-color: #dddddd;
                border-radius: 5px;
                padding-right: 5px;
                font-size: 11px;
                color: #666666;
            }
        }
    }
}

.el-card.ft-card {
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
