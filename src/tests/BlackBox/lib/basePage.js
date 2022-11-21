const { Builder, By, until } = require("selenium-webdriver");
const chrome = require("selenium-webdriver/chrome");
let o = new chrome.Options();
o.addArguments("start-fullscreen");
o.addArguments("disable-infobars");
o.addArguments("Zoom 80%");
o.setUserPreferences({ credential_enable_service: false });
o.excludeSwitches("enable-logging");

class Page {
  driver = new Builder().setChromeOptions(o).forBrowser("chrome").build();

  visit = async function (theUrl = this.theUrl) {
    return await this.driver.get(theUrl);
  };

  quit = async function () {
    return await this.driver.quit();
  };

  findById = async function (id) {
    await this.driver.wait(
      until.elementLocated(By.id(id)),
      15000,
      "Looking for element"
    );
    return await this.driver.findElement(By.id(id));
  };

  findByClassName = async function (name) {
    await this.driver.wait(
      until.elementLocated(By.className(name)),
      15000,
      "Looking for element"
    );
    return await this.driver.findElements(By.className(name));
  };

  findByClassNameOnly = async function (name) {
    await this.driver.wait(
      until.elementLocated(By.className(name)),
      15000,
      "Looking for element"
    );
    return await this.driver.findElement(By.className(name));
  };
}

module.exports = Page;
