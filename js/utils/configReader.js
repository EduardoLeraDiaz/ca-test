const appConfigElement = document.getElementById( 'appConfig' );
let appData = false;
if (appConfigElement) {
    appData = JSON.parse(appConfigElement.innerHTML);
    appConfigElement.parentNode.removeChild(appConfigElement);
}
export default appData;