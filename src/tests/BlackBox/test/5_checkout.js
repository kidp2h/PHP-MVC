const { describe, it } = require('mocha');
const Page = require('../lib/basePage');
const sleep = require('../utils/sleep');
const assert = require('chai').assert;

const testCase1 = async () => {
  describe('Checkout', async function () {
    this.timeout(50000);
    const page = new Page();

    it('not logged', async () => {
      await page.visit('http://localhost/cart');
      await sleep(2000);
      const currentUrl = await page.driver.getCurrentUrl();
      if (currentUrl === 'http://localhost/cart') {
        assert.fail();
      }
    });

    after(async () => {
      await page.quit();
    });
  });
};

const testCase2 = async () => {
  describe('Checkout', async function () {
    this.timeout(50000);
    const page = new Page();

    it('logged', async () => {
      await page.visit('http://localhost/signin');
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const btnSign = await page.findById('btn-signin');

      await inputUsername.clear();
      await inputPassword.clear();
      await inputUsername.sendKeys('admin');
      await inputPassword.sendKeys('admin');
      await btnSign.click();
      await sleep(2000);

      await page.visit('http://localhost/cart');
      await sleep(2000);

      const btnCheckOut = await page.findByClassNameOnly('cartPage__Checkout');
      await btnCheckOut.click();
      await page.findByClassNameOnly('cartList__Empty');
    });

    after(async () => {
      await page.quit();
    });
  });
};
