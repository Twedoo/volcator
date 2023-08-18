import Clipboard from "clipboard";

export function isNull(value) {
    return value === null || value === undefined;
}

export function isNotNull(value) {
    return value !== null && value !== undefined;
}

export function isEmptyStr(str) {
    //return (str === undefined) || (!str) || (!/[^\s]/.test(str));
    return (
        str === undefined ||
        (!str && str !== 0 && str !== '0') ||
        !/[^\s]/.test(str)
    );
}

export const generateId = function() {
    return Math.floor(
        Math.random() * 100000 + Math.random() * 20000 + Math.random() * 5000
    );
};

export const deepClone = function(origin) {
    if (origin === undefined) {
        return undefined;
    }

    return JSON.parse(JSON.stringify(origin));
};

export const overwriteObj = function(obj1, obj2) {
    /* 浅拷贝对象属性，obj2覆盖obj1 */
    // for (let prop in obj2) {
    //   if (obj2.hasOwnProperty(prop)) {
    //     obj1[prop] = obj2[prop]
    //   }
    // }

    Object.keys(obj2).forEach((prop) => {
        obj1[prop] = obj2[prop];
    });
};

export const addWindowResizeHandler = function(handler) {
    let oldHandler = window.onresize;
    if (typeof window.onresize != 'function') {
        window.onresize = handler;
    } else {
        window.onresize = function() {
            oldHandler();
            handler();
        };
    }
};

const createStyleSheet = function() {
    let head = document.head || document.getElementsByTagName('head')[0];
    let style = document.createElement('style');
    style.type = 'text/css';
    head.appendChild(style);
    return style.sheet;
};

export const insertCustomCssToHead = function(cssCode, formId = '') {
    let head = document.getElementsByTagName('head')[0];
    let oldStyle = document.getElementById('vform-custom-css');
    if (!!oldStyle) {
        head.removeChild(oldStyle); //先清除后插入！！
    }
    if (!!formId) {
        oldStyle = document.getElementById('vform-custom-css' + '-' + formId);
        !!oldStyle && head.removeChild(oldStyle); //先清除后插入！！
    }

    let newStyle = document.createElement('style');
    newStyle.type = 'text/css';
    newStyle.rel = 'stylesheet';
    newStyle.id = !!formId
        ? 'vform-custom-css' + '-' + formId
        : 'vform-custom-css';
    try {
        newStyle.appendChild(document.createTextNode(cssCode));
    } catch (ex) {
        newStyle.styleSheet.cssText = cssCode;
    }

    head.appendChild(newStyle);
};

export const insertGlobalFunctionsToHtml = function(
    functionsCode,
    formId = ''
) {
    let bodyEle = document.getElementsByTagName('body')[0];
    let oldScriptEle = document.getElementById('v_form_global_functions');
    !!oldScriptEle && bodyEle.removeChild(oldScriptEle); //先清除后插入！！
    if (!!formId) {
        oldScriptEle = document.getElementById(
            'v_form_global_functions' + '-' + formId
        );
        !!oldScriptEle && bodyEle.removeChild(oldScriptEle); //先清除后插入！！
    }

    let newScriptEle = document.createElement('script');
    newScriptEle.id = !!formId
        ? 'v_form_global_functions' + '-' + formId
        : 'v_form_global_functions';
    newScriptEle.type = 'text/javascript';
    newScriptEle.innerHTML = functionsCode;
    bodyEle.appendChild(newScriptEle);
};

export const optionExists = function(optionsObj, optionName) {
    if (!optionsObj) {
        return false;
    }

    return Object.keys(optionsObj).indexOf(optionName) > -1;
};

export const loadRemoteScript = function(srcPath, callback) {
    /*加载远程js，加载成功后执行回调函数*/
    let sid = encodeURIComponent(srcPath);
    let oldScriptEle = document.getElementById(sid);

    if (!oldScriptEle) {
        let s = document.createElement('script');
        s.src = srcPath;
        s.id = sid;
        document.body.appendChild(s);

        s.onload = s.onreadystatechange = function(_, isAbort) {
            /* 借鉴自ace.js */
            if (
                isAbort ||
                !s.readyState ||
                s.readyState === 'loaded' ||
                s.readyState === 'complete'
            ) {
                s = s.onload = s.onreadystatechange = null;
                if (!isAbort) {
                    callback();
                }
            }
        };
    }
};

export function traverseFieldWidgets(widgetList, handler, parent = null) {
    widgetList.map((w) => {
        if (w.formItemFlag) {
            handler(w, parent);
        } else if (w.type === 'grid') {
            w.cols.map((col) => {
                traverseFieldWidgets(col.widgetList, handler, w);
            });
        } else if (w.type === 'table') {
            w.rows.map((row) => {
                row.cols.map((cell) => {
                    traverseFieldWidgets(cell.widgetList, handler, w);
                });
            });
        } else if (w.type === 'tab') {
            w.tabs.map((tab) => {
                traverseFieldWidgets(tab.widgetList, handler, w);
            });
        } else if (w.type === 'sub-form') {
            traverseFieldWidgets(w.widgetList, handler, w);
        } else if (w.category === 'container') {
            //自定义容器
            traverseFieldWidgets(w.widgetList, handler, w);
        } else if (w.category === 'layout') {
            //自定义容器
            traverseFieldWidgets(w.widgetList, handler, w);
        }
    });
}

export function traverseContainerWidgets(widgetList, handler) {
    widgetList.map((w) => {
        if (w.category === 'container' || w.category === 'layout') {
            handler(w);
        }
        if (w.type === 'grid') {
            w.cols.map((col) => {
                traverseContainerWidgets(col.widgetList, handler);
            });
        } else if (w.type === 'table') {
            w.rows.map((row) => {
                row.cols.map((cell) => {
                    traverseContainerWidgets(cell.widgetList, handler);
                });
            });
        } else if (w.type === 'tab') {
            w.tabs.map((tab) => {
                traverseContainerWidgets(tab.widgetList, handler);
            });
        } else if (w.type === 'sub-form') {
            traverseContainerWidgets(w.widgetList, handler);
        } else if (w.category === 'container') {
            //自定义容器
            traverseContainerWidgets(w.widgetList, handler);
        } else if (w.category === 'layout') {
            //自定义容器
            traverseContainerWidgets(w.widgetList, handler);
        }
    });
}

export function traverseAllWidgets(widgetList, handler) {
    widgetList.map((w) => {
        handler(w);

        if (w.type === 'grid') {
            w.cols.map((col) => {
                handler(col);
                traverseAllWidgets(col.widgetList, handler);
            });
        } else if (w.type === 'table') {
            w.rows.map((row) => {
                row.cols.map((cell) => {
                    handler(cell);
                    traverseAllWidgets(cell.widgetList, handler);
                });
            });
        } else if (w.type === 'tab') {
            w.tabs.map((tab) => {
                traverseAllWidgets(tab.widgetList, handler);
            });
        } else if (w.type === 'sub-form') {
            traverseAllWidgets(w.widgetList, handler);
        } else if (w.category === 'container') {
            //自定义容器
            traverseAllWidgets(w.widgetList, handler);
        } else if (w.category === 'layout') {
            //自定义容器
            traverseAllWidgets(w.widgetList, handler);
        }
    });
}

function handleWidgetForTraverse(widget, handler) {
    if (!!widget.category) {
        traverseFieldWidgetsOfContainer(widget, handler);
    } else if (widget.formItemFlag) {
        handler(widget);
    }
}

/**
 * 遍历容器内的字段组件
 * @param con
 * @param handler
 */
export function traverseFieldWidgetsOfContainer(con, handler) {
    if (con.type === 'grid') {
        con.cols.forEach((col) => {
            col.widgetList.forEach((cw) => {
                handleWidgetForTraverse(cw, handler);
            });
        });
    } else if (con.type === 'table') {
        con.rows.forEach((row) => {
            row.cols.forEach((cell) => {
                cell.widgetList.forEach((cw) => {
                    handleWidgetForTraverse(cw, handler);
                });
            });
        });
    } else if (con.type === 'tab') {
        con.tabs.forEach((tab) => {
            tab.widgetList.forEach((cw) => {
                handleWidgetForTraverse(cw, handler);
            });
        });
    } else if (con.type === 'sub-form') {
        con.widgetList.forEach((cw) => {
            handleWidgetForTraverse(cw, handler);
        });
    } else if (con.category === 'container') {
        con.widgetList.forEach((cw) => {
            handleWidgetForTraverse(cw, handler);
        });
    } else if (con.category === 'layout') {
        con.widgetList.forEach((cw) => {
            handleWidgetForTraverse(cw, handler);
        });
    }
}

/**
 * 获取所有字段组件
 * @param widgetList
 * @returns {[]}
 */
export function getAllFieldWidgets(widgetList) {
    let result = [];
    let handlerFn = (w) => {
        result.push({
            type: w.type,
            name: w.options.name,
            field: w,
        });
    };
    traverseFieldWidgets(widgetList, handlerFn);

    return result;
}

/**
 * 获取所有容器组件
 * @param widgetList
 * @returns {[]}
 */
export function getAllContainerWidgets(widgetList) {
    let result = [];
    let handlerFn = (w) => {
        result.push({
            type: w.type,
            name: w.options.name,
            container: w,
        });
    };
    traverseContainerWidgets(widgetList, handlerFn);

    return result;
}

export function copyToClipboard(
    content,
    clickEvent,
    $message,
    successMsg,
    errorMsg
) {
    const clipboard = new Clipboard(clickEvent.target, {
        text: () => content,
    });

    clipboard.on('success', () => {
        $message.success(successMsg);
        clipboard.destroy();
    });

    clipboard.on('error', () => {
        $message.error(errorMsg);
        clipboard.destroy();
    });

    clipboard.onClick(clickEvent);
}

export function getQueryParam(variable) {
    let query = window.location.search.substring(1);
    let vars = query.split('&');
    for (let i = 0; i < vars.length; i++) {
        let pair = vars[i].split('=');
        if (pair[0] == variable) {
            return pair[1];
        }
    }

    return undefined;
}

export function getDefaultFormConfig() {
    return {
        initSpaceApplicationId: '',
        applicationId: '',
        pageId: '',
        applicationName: '',
        newApplication: true,
        homePage: true,
        pageName: "index",
        modelName: 'volcatorData',
        refName: 'volcatorForm',
        rulesName: 'rules',
        labelWidth: 80,
        labelPosition: 'left',
        container: 'Large',
        gateCheckAuthorized: true,
        droppableButton: true,
        previewOrRender: false,
        size: '',
        labelAlign: 'label-left-align',
        cssCode: '',
        customClass: '',
        functions: '', //全局函数
        layoutType: 'PC',
        jsonVersion: 3,

        onFormCreated: '',
        onFormMounted: '',
        onFormDataChange: '',
    };
}

export function buildDefaultFormJson() {
    return {
        widgetList: [],
        formConfig: deepClone(getDefaultFormConfig()),
    };
}


export function loadFormConfigByElement(el = null) {
    const jsonString = window.localStorage.getItem("form__config__backup");
    if (jsonString) {
        const json = JSON.parse(jsonString);

        if (el !== null && typeof json === 'object') {
            return json[el];
        } else {
            console.error("Invalid JSON or index value.");
        }
    }

    return null;
}


export function loadWidgetList() {
    const widgetListBackup = window.localStorage.getItem("widget__list__backup");
    return JSON.parse(widgetListBackup);
}

export function loadFormConfig() {
    // const formConfigBackup = window.localStorage.getItem("form__config__backup");
    // return JSON.parse(formConfigBackup);
    const formConfigBackup = window.localStorage.getItem("form__config__backup");
    return formConfigBackup ? JSON.parse( window.localStorage.getItem("form__config__backup")) : {};
}

export function saveFormConfig(formConfig) {
    window.localStorage.setItem(
        "form__config__backup",
        JSON.stringify(formConfig)
    );
}
