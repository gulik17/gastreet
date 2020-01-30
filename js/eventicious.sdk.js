/**
 * Модуль взаимодействия с нативной частью
 * @dependence  EventiciousSDK, EvNotification, EventiciousCallbacks
 */

// Заглушки для тестирования в браузере
var EventiciousSDK = EventiciousSDK || {
  Buttons: {
    Left: {},
    Right: {},
  }
};
var EventiciousCallbacks = EventiciousCallbacks || {};
var EvNotification = EvNotification || function() {};

// Модуль
var Native = (function(SDK, Notification, Callbacks) {
  "use strict";

  var Native = function() {

    // Типы кнопок в навбаре
    this.BUTTON_IMAGE_TYPE_BACK = 0; // стрелка
    this.BUTTON_IMAGE_TYPE_CLOSE = 1; // крестик
    this.BUTTON_IMAGE_TYPE_MENU = 2; // "гамбургер"
    
    // Левая кнопка навбара
    this.leftButton = {
      setText: function(text){
        SDK.Buttons.Left.setText && SDK.Buttons.Left.setText(text);
      },
      setImage: function (type) {
        if (SDK.Buttons.Left.setImageType) {
          SDK.Buttons.Left.setImageType(type);
        }
      },
      setVisible: function(visible){ 
        SDK.Buttons.Left.setVisible && SDK.Buttons.Left.setVisible(visible);
      },
      setEnabled: function(enabled){ 
        SDK.Buttons.Left.setEnabled && SDK.Buttons.Left.setEnabled(enabled);
      },
      onClick: function (callback) {
        EventiciousCallbacks.OnLeftButtonClicked = callback || function () {
          };
      },
    };

    // Правая кнопка навбара
    this.rightButton = {
      setText: function(text){
        SDK.Buttons.Right.setText && SDK.Buttons.Right.setText(text);
      },
      setImage: function (type) {
        if (SDK.Buttons.Right.setImageType) {
          SDK.Buttons.Right.setImageType(type);
        }
      },
      setVisible: function(visible){ 
        SDK.Buttons.Right.setVisible && SDK.Buttons.Right.setVisible(visible);
      },
      setEnabled: function(enabled){ 
        SDK.Buttons.Right.setEnabled && SDK.Buttons.Right.setEnabled(enabled);
      },
      onClick: function (callback) {
        EventiciousCallbacks.OnRightButtonClicked = callback || function () {
          };
      },
    };

    // Открыть сайдбар
    this.showMenu = function() {
      try {
        SDK.showMenu();
      } 
      catch(e) {
        console.log('SDK.showMenu');
      }
    };

    // Выставить заголовок экрана
    this.setTitle = function(title) {
      try {
        SDK.setTitle(title);
      } 
      catch(e) {
        console.log('SDK.setTitle', title);
      }
    };

    // Нативный алерт, с возможность переопределять заголовок
    this.customAlert = function(title, message) {
      try {
        SDK.customAlert(title, message);
      }
      catch(e) {
        console.log('SDK.customAlert', title, message);
      }
    };

    // Получить Id текущего события
    this.getEventId = function() {
      try {
        return parseInt(SDK.getCurrentConferenceId());
      }
      catch (e) { 
        console.log('SDK.getEventId');
      }
    }

    // Профиль участнки
    this.getProfile = function(eventId) {
      return SDK.getProfile(eventId);
    }

  };

  return new Native();

})(EventiciousSDK, EvNotification, EventiciousCallbacks);
