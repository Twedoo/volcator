export const containersX = {
    type: "grid",
    category: "container",
    icon: "grid",
    cols: [],
    options: {
        name: "",
        hidden: false,
        gutter: 12,
        colHeight: null, //栅格列统一高度属性，用于解决栅格列设置响应式布局浮动后被挂住的问题！！
        customClass: "", //自定义css类名
        menuVertical: "rear" //自定义css类名
    }
};

export const layouts = [
    {
        type: "default-horizontal",
        category: "layout",
        icon: "grid",
        options: {
            name: "",
            label: ""
        }
    },
    {
        type: "basic-horizontal",
        category: "layout",
        icon: "grid",
        widgetList: [],
        options: {
            name: "",
            label: ""
        }
    },
    {
        type: "header-item",
        category: "layout",
        icon: "grid",
        internal: true,
        widgetList: [],
        options: {
            name: "",
            backgroundColor: "",
            activeCustomBackgroundColor: false,
            flex: "None",
            alignItem: "",
            justify: "",
            boxShadow: ""
        }
    },
    {
        type: "main-item",
        category: "layout",
        icon: "grid",
        internal: true,
        widgetList: [],
        options: {
            name: "",
            label: ""
        }
    },
    {
        type: "default-vertical",
        category: "container",
        icon: "grid",
        options: {
            name: "",
            label: ""
        }
    },
    {
        type: "basic-vertical",
        category: "container",
        icon: "grid",
        options: {
            name: "",
            label: ""
        }
    },
    {
        type: "default-aside-top-vertical",
        category: "container",
        icon: "grid",
        options: {
            name: "",
            label: ""
        }
    },
    {
        type: "basic-aside-top-vertical",
        category: "container",
        icon: "grid",
        options: {
            name: "",
            label: ""
        }
    },
    {
        type: "aside-vertical",
        category: "container",
        icon: "grid",
        options: {
            name: "",
            label: ""
        }
    }
];

export const containers = [
    {
        type: "container",
        category: "container",
        icon: "grid",
        widgetList: [],
        options: {
            name: "",
            container: "Full",
            backgroundColor: "",
            activeCustomBackgroundColor: false,

            // color background config
            activeGradientBg: false,
            bgColor: "tsz-bg-sky-500",
            directionGradientBg: "tsz-bg-gradient-to-r",
            fromColorBg: "tsz-from-green-400",
            viaColorBg: "",
            toColorBg: "tsz-to-blue-500",

            flex: "tsz-flex",
            flexWrap: "None",
            alignItem: "",
            justify: "",
            overflow: "tsz-overflow-hidden",
            boxShadow: "",
            margin: "",
            padding: "",
            width: "",
            height: "",
            minWidth: "",
            maxWidth: "",
            maxHeight: "",
            minHeight: "",
            border: ["tsz-rounded"],
            position: "",
            placementTrbl: "",
            float: "",
            objectPosition: "",
            hidden: false,
            customClass: ""
        }
    },
    {
        type: "flexible",
        category: "container",
        icon: "grid",
        widgetList: [],
        options: {
            name: "",
            backgroundColor: "",
            activeCustomBackgroundColor: false,
            alignItem: "",
            justify: "",
            overflow: "tsz-overflow-hidden",
            boxShadow: "",
            hidden: false,
            customClass: "" //自定义css类名
        }
    },
    {
        type: "grid",
        category: "container",
        icon: "grid",
        cols: [],
        options: {
            name: "",
            hidden: false,
            backgroundColor: "",
            activeCustomBackgroundColor: false,
            // color background config
            activeGradientBg: false,
            bgColor: "tsz-bg-sky-500",
            directionGradientBg: "tsz-bg-gradient-to-r",
            fromColorBg: "tsz-from-green-400",
            viaColorBg: "",
            toColorBg: "tsz-to-blue-500",

            height: "",
            width: "",
            overflow: "tsz-overflow-hidden",
            border: "",
            boxShadow: "",
            margin: "",
            padding: "",
            gutter: 12,
            gridNumber: "2",
            gap: "4",
            colHeight: null, //栅格列统一高度属性，用于解决栅格列设置响应式布局浮动后被挂住的问题！！
            customClass: "", //自定义css类名
            menuVertical: "rear" //自定义css类名
        }
    },
    {
        type: "grid-col",
        category: "container",
        icon: "grid-col",
        internal: true,
        widgetList: [],
        options: {
            name: "",
            backgroundColor: "",
            activeCustomBackgroundColor: false,
            flex: "None",
            alignItem: "",
            justify: "",
            overflow: "tsz-overflow-hidden",
            // color background config
            activeGradientBg: false,
            bgColor: "tsz-bg-sky-500",
            directionGradientBg: "tsz-bg-gradient-to-r",
            fromColorBg: "tsz-from-green-400",
            viaColorBg: "",
            toColorBg: "tsz-to-blue-500",

            boxShadow: "",
            colSpan: "1",
            hidden: false,
            span: 12,
            offset: 0,
            push: 0,
            pull: 0,
            responsive: false, //是否开启响应式布局
            md: 12,
            sm: 12,
            xs: 12,
            customClass: "" //自定义css类名
        }
    },
    {
        type: "table",
        category: "container",
        icon: "table",
        rows: [],
        options: {
            name: "",
            hidden: false,
            customClass: "" //自定义css类名
        }
    },
    {
        type: "tab",
        category: "container",
        icon: "tab",
        displayType: "border-card",
        tabs: [],
        options: {
            name: "",
            hidden: false,
            customClass: "" //自定义css类名
        }
    },
    {
        type: "table-cell",
        category: "container",
        icon: "table-cell",
        internal: true,
        widgetList: [],
        merged: false,
        options: {
            name: "",
            cellWidth: "",
            cellHeight: "",
            colspan: 1,
            rowspan: 1,
            customClass: "" //自定义css类名
        }
    },

    {
        type: "tab-pane",
        category: "container",
        icon: "tab-pane",
        internal: true,
        widgetList: [],
        options: {
            name: "",
            label: "",
            hidden: false,
            active: false,
            disabled: false,
            customClass: "" //自定义css类名
        }
    }
];

export const basicFields = [
    {
        type: "input",
        icon: "text-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            type: "text",
            defaultValue: "",
            placeholder: "",
            color: "tsz-text-cyan-500",
            width: "tsz-w-full",
            height: "tsz-w-full",
            padding: "tsz-p-0.5",
            margin: "",
            columnWidth: "200px",
            size: "",
            border: ["tsz-rounded", "tsz-border"],
            borderColor: "",
            borderColorFocus: "",
            borderRing: "",
            outline: "",
            outlineFocus: ["tsz-outline-none"],
            boxShadow: "",
            labelWidth: null,
            labelHidden: false,
            readonly: false,
            disabled: false,
            hidden: false,
            clearable: true,
            showPassword: false,
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
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
            buttonIcon: "custom-search",
            //-------------------
            onCreated: "",
            onMounted: "",
            onInput: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: "",
            onAppendButtonClick: ""

            // name: "",
            // container: "Full",
            // backgroundColor: "",
            // flex: "tsz-flex",
            // flexWrap: "None",
            // alignItem: "",
            // justify: "",
            // boxShadow: "",
            // margin: "",
            // padding: "",
            // width: "",
            // minWidth: "",
            // maxWidth: "",
            // height: "",
            // maxHeight: "",
            // minHeight: "",
            // border: ["tsz-rounded"],
            // position: "",
            // placementTrbl: "",
            // float: "",
            // objectPosition: "",
            // hidden: false,
            // customClass: ""

        }
    },

    {
        type: "textarea",
        icon: "textarea-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
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
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            minLength: null,
            maxLength: null,
            showWordLimit: false,
            //-------------------
            onCreated: "",
            onMounted: "",
            onInput: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },

    {
        type: "number",
        icon: "number-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: 0,
            placeholder: "",
            columnWidth: "200px",
            size: "",
            labelWidth: null,
            labelHidden: false,
            disabled: false,
            hidden: false,
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            min: -100000000000,
            max: 100000000000,
            precision: 0,
            step: 1,
            controlsPosition: "right",
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },

    {
        type: "radio",
        icon: "radio-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: null,
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
                { label: "radio 1", value: 1 },
                { label: "radio 2", value: 2 },
                { label: "radio 3", value: 3 }
            ],
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onValidate: ""
        }
    },

    {
        type: "checkbox",
        icon: "checkbox-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
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
                { label: "check 1", value: 1 },
                { label: "check 2", value: 2 },
                { label: "check 3", value: 3 }
            ],
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onValidate: ""
        }
    },

    {
        type: "select",
        icon: "select-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: "",
            placeholder: "",
            columnWidth: "200px",
            size: "",
            labelWidth: null,
            labelHidden: false,
            disabled: false,
            hidden: false,
            clearable: true,
            filterable: false,
            allowCreate: false,
            remote: false,
            automaticDropdown: false, //自动下拉
            multiple: false,
            multipleLimit: 0,
            optionItems: [
                { label: "select 1", value: 1 },
                { label: "select 2", value: 2 },
                { label: "select 3", value: 3 }
            ],
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onRemoteQuery: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },

    {
        type: "time",
        icon: "time-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: null,
            placeholder: "",
            columnWidth: "200px",
            size: "",
            autoFullWidth: true,
            labelWidth: null,
            labelHidden: false,
            readonly: false,
            disabled: false,
            hidden: false,
            clearable: true,
            editable: false,
            format: "HH:mm:ss", //时间格式
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },

    {
        type: "time-range",
        icon: "time-range-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: null,
            startPlaceholder: "",
            endPlaceholder: "",
            columnWidth: "200px",
            size: "",
            autoFullWidth: true,
            labelWidth: null,
            labelHidden: false,
            readonly: false,
            disabled: false,
            hidden: false,
            clearable: true,
            editable: false,
            format: "HH:mm:ss", //时间格式
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },

    {
        type: "date",
        icon: "date-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            type: "date",
            defaultValue: null,
            placeholder: "",
            columnWidth: "200px",
            size: "",
            autoFullWidth: true,
            labelWidth: null,
            labelHidden: false,
            readonly: false,
            disabled: false,
            hidden: false,
            clearable: true,
            editable: false,
            format: "YYYY-MM-DD", //日期显示格式
            valueFormat: "YYYY-MM-DD", //日期对象格式
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },

    {
        type: "date-range",
        icon: "date-range-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            type: "daterange",
            defaultValue: null,
            startPlaceholder: "",
            endPlaceholder: "",
            columnWidth: "200px",
            size: "",
            autoFullWidth: true,
            labelWidth: null,
            labelHidden: false,
            readonly: false,
            disabled: false,
            hidden: false,
            clearable: true,
            editable: false,
            format: "YYYY-MM-DD", //日期显示格式
            valueFormat: "YYYY-MM-DD", //日期对象格式
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },

    {
        type: "switch",
        icon: "switch-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: null,
            columnWidth: "200px",
            labelWidth: null,
            labelHidden: false,
            disabled: false,
            hidden: false,
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            switchWidth: 40,
            activeText: "",
            inactiveText: "",
            activeColor: null,
            inactiveColor: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onValidate: ""
        }
    },

    {
        type: "rate",
        icon: "rate-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: null,
            columnWidth: "200px",
            labelWidth: null,
            labelHidden: false,
            disabled: false,
            hidden: false,
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            max: 5,
            lowThreshold: 2,
            highThreshold: 4,
            allowHalf: false,
            showText: false,
            showScore: false,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onValidate: ""
        }
    },

    {
        type: "color",
        icon: "color-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: null,
            columnWidth: "200px",
            size: "",
            labelWidth: null,
            labelHidden: false,
            disabled: false,
            hidden: false,
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onValidate: ""
        }
    },

    {
        type: "slider",
        icon: "slider-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            columnWidth: "200px",
            showStops: true,
            size: "",
            labelWidth: null,
            labelHidden: false,
            disabled: false,
            hidden: false,
            required: false,
            requiredHint: "",
            validation: "",
            validationHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            min: 0,
            max: 100,
            step: 10,
            range: false,
            //vertical: false,
            height: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onValidate: ""
        }
    },

    {
        type: "static-text",
        icon: "static-text",
        formItemFlag: false,
        options: {
            name: "",
            textContent: "static text",
            activeGradient: false,
            color: "tsz-text-cyan-500",
            directionGradient: "tsz-bg-gradient-to-r",
            fromColor: "tsz-from-purple-800",
            viaColor: "tsz-via-rose-400",
            toColor: "tsz-to-cyan-700",

            size: "tsz-text-base",
            font: "tsz-font-sans",
            decoration: "",
            style: "",
            list: "",
            space: "",
            width: "",
            height: "",
            margin: "",
            padding: "",
            //-------------------
            customClass: "", //自定义css类名
            //-------------------
            onCreated: "",
            onMounted: ""
        }
    },

    {
        type: "html-text",
        icon: "html-text",
        formItemFlag: false,
        options: {
            name: "",
            columnWidth: "200px",
            hidden: false,
            htmlContent: "<b>html text</b>",
            //-------------------
            customClass: "", //自定义css类名
            //-------------------
            onCreated: "",
            onMounted: ""
        }
    },

    {
        type: "button",
        icon: "button",
        formItemFlag: false,
        options: {
            name: "",
            label: "",
            columnWidth: "200px",

            // dimension config
            width: "tsz-w-20",
            height: "tsz-h-8",
            padding: "tsz-p-0.5",
            margin: "",

            // text config
            size: "tsz-text-base",
            font: "tsz-font-sans",
            decoration: "",
            style: "tsz-font-semibold",
            list: "",
            space: "",

            // color background config
            activeGradientBg: false,
            bgColor: "tsz-bg-sky-500",
            directionGradientBg: "tsz-bg-gradient-to-r",
            fromColorBg: "tsz-from-green-400",
            viaColorBg: "",
            toColorBg: "tsz-to-blue-500",

            // color config
            activeGradient: false,
            color: "tsz-text-white",
            directionGradient: "tsz-bg-gradient-to-r",
            fromColor: "tsz-from-purple-800",
            viaColor: "tsz-via-rose-400",
            toColor: "tsz-to-cyan-700",

            backgroundColor: "",
            activeCustomBackgroundColor: false,

            // border config
            border: ["tsz-rounded", "tsz-border"],
            borderColor: "",
            borderColorFocus: "",
            borderRing: "",
            outline: "",
            outlineFocus: ["tsz-outline-none"],
            boxShadow: "",

            displayStyle: "block",
            disabled: false,
            hidden: false,
            type: "",
            plain: false,
            round: false,
            circle: false,
            icon: null,
            //-------------------
            customClass: "", //自定义css类名
            //-------------------
            onCreated: "",
            onMounted: "",
            onClick: ""
        }
    },

    {
        type: "divider",
        icon: "divider",
        formItemFlag: false,
        options: {
            name: "",
            label: "",
            columnWidth: "200px",
            direction: "horizontal",
            contentPosition: "center",
            hidden: false,
            //-------------------
            customClass: "", //自定义css类名
            //-------------------
            onCreated: "",
            onMounted: ""
        }
    }

    //
];

export const advancedFields = [
    {
        type: "picture-space",
        icon: "picture-upload-field",
        formItemFlag: true,
        options: {
            name: "",
            width: "tsz-w-96",
            height: "tsz-h-96",
            padding: "",
            margin: "",
            pictureBg: "",
            pictureBgSize: "tsz-bg-cover",
            pictureBgRepeat: "tsz-bg-no-repeat",
            pictureBgOrigin: "",
            pictureBgPosition: "",
            pictureBgAttachment: "tsz-bg-local",

            // Border
            border: ["tsz-rounded"],

            //-------------------
            uploadURL: "",
            uploadTip: "",
            withCredentials: false,
            multipleSelect: false,
            showFileList: true,
            limit: 3,
            fileMaxSize: 5, //MB
            fileTypes: ["jpg", "jpeg", "png"],
            //headers: [],
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onBeforeUpload: "",
            onUploadSuccess: "",
            onUploadError: "",
            onFileRemove: "",
            onValidate: ""
            //onFileChange: '',
        }
    },

    {
        type: "file-upload",
        icon: "file-upload-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            labelWidth: null,
            labelHidden: false,
            columnWidth: "200px",
            disabled: false,
            hidden: false,
            required: false,
            requiredHint: "",
            customRule: "",
            customRuleHint: "",
            //-------------------
            uploadURL: "",
            uploadTip: "",
            withCredentials: false,
            multipleSelect: false,
            showFileList: true,
            limit: 3,
            fileMaxSize: 5, //MB
            fileTypes: ["doc", "docx", "xls", "xlsx"],
            //headers: [],
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onBeforeUpload: "",
            onUploadSuccess: "",
            onUploadError: "",
            onFileRemove: "",
            onValidate: ""
            //onFileChange: '',
        }
    },

    {
        type: "rich-editor",
        icon: "rich-editor-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            placeholder: "",
            labelWidth: null,
            labelHidden: false,
            columnWidth: "200px",
            contentHeight: "200px",
            disabled: false,
            hidden: false,
            required: false,
            requiredHint: "",
            customRule: "",
            customRuleHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            minLength: null,
            maxLength: null,
            showWordLimit: false,
            //-------------------
            onCreated: "",
            onMounted: "",
            onValidate: ""
        }
    },

    {
        type: "cascader",
        icon: "cascader-field",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: "",
            placeholder: "",
            size: "",
            labelWidth: null,
            labelHidden: false,
            columnWidth: "200px",
            disabled: false,
            hidden: false,
            clearable: true,
            filterable: false,
            multiple: false,
            checkStrictly: false, //可选择任意一级选项，默认不开启
            showAllLevels: true, //显示完整路径
            optionItems: [
                {
                    label: "select 1",
                    value: 1,
                    children: [{ label: "child 1", value: 11 }]
                },
                { label: "select 2", value: 2 },
                { label: "select 3", value: 3 }
            ],
            required: false,
            requiredHint: "",
            customRule: "",
            customRuleHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },
    {
        type: "menu-vertical",
        icon: "document",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: "",
            placeholder: "",
            size: "",
            labelWidth: null,
            labelHidden: false,
            columnWidth: "200px",
            disabled: false,
            hidden: false,
            clearable: true,
            filterable: false,
            multiple: false,
            checkStrictly: false, //可选择任意一级选项，默认不开启
            showAllLevels: true, //显示完整路径
            optionItems: [
                {
                    label: "select 1",
                    value: 1,
                    children: [{ label: "child 1", value: 11 }]
                },
                { label: "select 2", value: 2 },
                { label: "select 3", value: 3 }
            ],
            required: false,
            requiredHint: "",
            customRule: "",
            customRuleHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },
    {
        type: "menu-horizontal",
        icon: "document",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: "",
            placeholder: "",
            size: "",
            labelWidth: null,
            labelHidden: false,
            columnWidth: "200px",
            disabled: false,
            hidden: false,
            clearable: true,
            filterable: false,
            multiple: false,
            checkStrictly: false, //可选择任意一级选项，默认不开启
            showAllLevels: true, //显示完整路径
            optionItems: [
                {
                    label: "select 1",
                    value: 1,
                    children: [{ label: "child 1", value: 11 }]
                },
                { label: "select 2", value: 2 },
                { label: "select 3", value: 3 }
            ],
            required: false,
            requiredHint: "",
            customRule: "",
            customRuleHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },
    {
        type: "carousel",
        icon: "set-up",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: "",
            placeholder: "",
            size: "",
            labelWidth: null,
            labelHidden: false,
            columnWidth: "200px",
            disabled: false,
            hidden: false,
            clearable: true,
            filterable: false,
            multiple: false,
            checkStrictly: false, //可选择任意一级选项，默认不开启
            showAllLevels: true, //显示完整路径
            optionItems: [
                {
                    label: "select 1",
                    value: 1,
                    children: [{ label: "child 1", value: 11 }]
                },
                { label: "select 2", value: 2 },
                { label: "select 3", value: 3 }
            ],
            required: false,
            requiredHint: "",
            customRule: "",
            customRuleHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    },
    {
        type: "card",
        icon: "card",
        formItemFlag: true,
        options: {
            name: "",
            label: "",
            labelAlign: "",
            defaultValue: "",
            placeholder: "",
            size: "",
            labelWidth: null,
            labelHidden: false,
            columnWidth: "200px",
            disabled: false,
            hidden: false,
            clearable: true,
            filterable: false,
            multiple: false,
            checkStrictly: false, //可选择任意一级选项，默认不开启
            showAllLevels: true, //显示完整路径
            optionItems: [
                {
                    label: "select 1",
                    value: 1,
                    children: [{ label: "child 1", value: 11 }]
                },
                { label: "select 2", value: 2 },
                { label: "select 3", value: 3 }
            ],
            required: false,
            requiredHint: "",
            customRule: "",
            customRuleHint: "",
            //-------------------
            customClass: "", //自定义css类名
            labelIconClass: null,
            labelIconPosition: "rear",
            labelTooltip: null,
            //-------------------
            onCreated: "",
            onMounted: "",
            onChange: "",
            onFocus: "",
            onBlur: "",
            onValidate: ""
        }
    }
];

export const customFields = [];

export function addLayoutsWidgetSchema(layoutsSchema) {
    layouts.push(layoutsSchema);
}

export function addContainerWidgetSchema(containerSchema) {
    containers.push(containerSchema);
}

export function addBasicFieldSchema(fieldSchema) {
    basicFields.push(fieldSchema);
}

export function addAdvancedFieldSchema(fieldSchema) {
    advancedFields.push(fieldSchema);
}

export function addCustomWidgetSchema(widgetSchema) {
    customFields.push(widgetSchema);
}
