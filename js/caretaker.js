var snapshotElements = {
    list: {},

    set: function (eName, eValue) {
        if ( Boolean(eName) ) {
            eName = String(eName);
            eValue = String(eValue);

            this.list[eName] = eValue;
        }
    },

    get: function (eName) {
        if ( Boolean(eName) ) {
            eName = String(eName);

            return this.list[eName];
        }
        else {
            return undefined;
        }
    },

    remove: function (eName) {
        if ( Boolean(eName) ) {
            eName = String(eName);

            delete this.list[eName];
        }
    },

    clean: function () {
        this.list = {};
    },

    size: function () {
        var size = 0;

        for (var key in this.list) {
            size++;
        }

        return size;
    }
};

// "отключение" calcMD5()
/*
function calcMD5(s) {
    return s;
}
/**/

function createSnapshot() {
    console.log("createSnapshot");

    var prefixName, eName, eValue, eChecked, ckName, ckValue;

    /* поиск всех элементов text (<input type="text" />) */
    /* (атрибут name и его значение - обязательно) */

    prefixName = "inputText_";
    $("input[type=text]").each(function () {
        eName = this.name;
        eValue = this.value;

        if (eName) {
            ckName = prefixName + eName;
            ckValue = calcMD5(eValue);

            snapshotElements.set(ckName, ckValue);
        }
    });

    /* поиск всех элементов textarea */
    /* (атрибут name и его значение - обязательно) */

    prefixName = "textarea_";
    $("textarea").each(function () {
        eName = this.name;
        eValue = this.value;

        if (eName) {
            ckName = prefixName + eName;
            ckValue = calcMD5(eValue);

            snapshotElements.set(ckName, ckValue);
        }
    });

    /* поиск всех элементов select */
    /* (атрибут name и его значение - обязательно) */

    prefixName = "select_";
    $("select").each(function () {
        eName = this.name;
        eValue = this.value;

        if (eName) {
            ckName = prefixName + eName;
            ckValue = calcMD5(eValue);

            snapshotElements.set(ckName, ckValue);
        }
    });

    /* поиск всех элементов checkbox (<input type="checkbox" />) */
    /* (атрибут name и его значение - обязательно) */

    prefixName = "inputCheckbox_";
    $("input[type=checkbox]").each(function () {
        eName = this.name;
        eChecked = this.checked;

        if (eName) {
            ckName = prefixName + eName;
            ckValue = Number(eChecked);

            snapshotElements.set(ckName, ckValue);
        }
    });

    /* поиск всех элементов radio (<input type="radio" />) */
    /* (атрибут name и его значение - обязательно) */

    prefixName = "inputRadio_";
    $("input[type=radio]").each(function () {
        eName = this.name;
        eValue = this.value;
        eChecked = this.checked;

        if (eName && eChecked) {
            ckName = prefixName + eName;
            ckValue = calcMD5(eValue);

            snapshotElements.set(ckName, ckValue);

            return false;
        }
    });

    /*
    console.log("");
    for (var key in snapshotElements.list) {
        console.log(key + " = " + snapshotElements.list[key]);
    }
    /**/
}

function compareSnapshot() {
    console.log("compareSnapshot");

    var prefixName, eName, eValue, eChecked, ckName, ckValue, isChangeElement = false;

    if (snapshotElements.size() === 0) {
        return true;
    }

    prefixName = "inputText_";
    $("input[type=text]").each(function () {
        eName = this.name;
        eValue = this.value;

        if (eName) {
            ckName = prefixName + eName;
            ckValue = snapshotElements.get(ckName);

            if (typeof(ckValue) !== "undefined") {
                if (ckValue != calcMD5(eValue)) {
                    isChangeElement = true;
                    console.log("Warning: element '" + eName + "' has been changed!");
                }
            }
        }
    });

    prefixName = "textarea_";
    $("textarea").each(function () {
        eName = this.name;
        eValue = this.value;

        if (eName) {
            ckName = prefixName + eName;
            ckValue = snapshotElements.get(ckName);

            if (typeof(ckValue) !== "undefined") {
                if (ckValue != calcMD5(eValue)) {
                    isChangeElement = true;
                    console.log("Warning: element '" + eName + "' has been changed!");
                }
            }
        }
    });

    prefixName = "select_";
    $("select").each(function () {
        eName = this.name;
        eValue = this.value;

        if (eName) {
            ckName = prefixName + eName;
            ckValue = snapshotElements.get(ckName);

            if (typeof(ckValue) !== "undefined") {
                if (ckValue != calcMD5(eValue)) {
                    isChangeElement = true;
                    console.log("Warning: element '" + eName + "' has been changed!");
                }
            }
        }
    });

    prefixName = "inputCheckbox_";
    $("input[type=checkbox]").each(function () {
        eName = this.name;
        eChecked = this.checked;

        if (eName) {
            ckName = prefixName + eName;
            ckValue = snapshotElements.get(ckName);

            if (typeof(ckValue) !== "undefined") {
                if (ckValue != eChecked) {
                    isChangeElement = true;
                    console.log("Warning: element '" + eName + "' has been changed!");
                }
            }
        }
    });

    prefixName = "inputRadio_";
    $("input[type=radio]").each(function () {
        eName = this.name;
        eValue = this.value;
        eChecked = this.checked;

        if (eName && eChecked) {
            ckName = prefixName + eName;
            ckValue = snapshotElements.get(ckName);

            if (typeof(ckValue) !== "undefined") {
                if (ckValue != calcMD5(eValue)) {
                    isChangeElement = true;
                    console.log("Warning: element '" + eName + "' has been changed!");
                }
            }
        }
    });

    if (isChangeElement) {
        return false;  // На текущей странице были сделаны изменения!
    }
    else {
        return true;
    }
}

function ignoreSnapshot() {
    console.log("ignoreSnapshot");

    snapshotElements.clean();
}

/* страница и все ресурсы - загружены */
window.addEventListener("load", createSnapshot);

/*
отлавливание событий:
    1) нажатие кнопки "Назад" (кнопка браузера)
    2) нажатие кнопки "Обновить" (кнопка браузера)
    3) нажатие кнопки "Закрыть" (закрытие текущей вкладки или браузера)
    4) переход по ссылке (тег <a>)
    5) отправка формы (тег <form>)
*/
window.onbeforeunload = function () {
    if (!compareSnapshot()) {
        return "На текущей странице были сделаны изменения!";
    }
};