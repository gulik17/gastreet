$(function() {

});

var fullLog = "";

function callStartSession(session, url) {
    let merchantId = "merchant.com.gastreet";
    let text = "\nstartSession Results" + "\n";
    $.post("/authorizemerchant",
        {"merchantId" : merchantId, "url" : url, "displayName" : "gastreet.com"},
        function( data ) {ll
            try {
                merchantSession = JSON.parse(data);
                merchantSession = merchantSession['statusMessage'];
            } catch (e) {
//            this should never happen in our situation, unless a bad build
                appendFullLog("startSession response is not valid JSON:\n" + data + "\nApplePaySession cancelled by Apple Pay Demo Site\n");
                cancelPaymentSession(session);
            }
            //cleaning the data
            var sanitize = JSON.parse(data);
            sanitize = sanitize['statusMessage'];
            sanitize['signature'] = "REDACTED";
            sanitize['merchantSessionIdentifier'] = "REDACTED";
            sanitize['merchantIdentifier'] = "REDACTED";

            text += JSON.stringify(sanitize, undefined, 4);
            // Stop the session if merchantSession is not valid
            if (typeof merchantSession === 'string' || 'statusCode' in merchantSession) {
                appendFullLog("startSession failed:\n" + text + "\nApplePaySession cancelled by Apple Pay Demo Site\n");
                cancelPaymentSession(session);
                return;
            }
            if (!('merchantIdentifier' in merchantSession && 'merchantSessionIdentifier' in merchantSession && ('nOnce' in merchantSession || 'nonce' in merchantSession))) {
                var errorDescription = 'merchantSession is invalid. Payment Session cancelled by Apple Pay Demo Site.\n';
                if (!('merchantIdentifier' in merchantSession)) {
                    errorDescription += 'merchantIdentifier is not found in merchantSession.\n';
                }
                if (!('merchantSessionIdentifier' in merchantSession)) {
                    errorDescription += 'merchantSessionIdentifier is not found in merchantSession.\n';
                }
                if (!('nOnce' in merchantSession)) {
                    errorDescription += 'nonce is not found in merchantSession\n';
                }
                errorDescription += text;
                appendFullLog(errorDescription);
                cancelPaymentSession(session);
                return;
            }

            appendFullLog(text);
            if (session !== null) {
                currentMerchantId = merchantId;
                var completeResult = completeMerchantValidation(session, merchantSession);
            }
        }, 'text')
        .fail(function(xhr, textStatus, errorThrown) {
            appendFullLog(xhr.responseText);
            if (session !== null) {
                cancelPaymentSession(session);
            }
        });
}

function cancelPaymentSession(session) {
    if (session !== null)
        session.abort();
}

function startApplePaySession() {
    if (typeof ApplePaySession === 'undefined') {
        alert("Your browser does not support Apple Pay. Please switch to a supported browser.");
    }
    const paymentRequest = {
        total: {
            label: 'gastreet.com',
            amount: 50
        },
        countryCode: 'RU',
        currencyCode: 'RUB',
        merchantCapabilities: ['supports3DS'],
        supportedNetworks: ['masterCard', 'visa']
    };

    const applePaySession = new window.ApplePaySession(1, paymentRequest);

    applePaySession.onvalidatemerchant = function onvalidatemerchant(event) {
        callStartSession(applePaySession, event.validationURL);
    };

    applePaySession.begin();
}

function appendFullLog(text) {
    fullLog += text + '\n';
    $("#fulllogconsole").text(fullLog);
}

function clearLogs() {
    fullLog = '';
    consoleLog = '';
    $("#fulllogconsle").text('');
}