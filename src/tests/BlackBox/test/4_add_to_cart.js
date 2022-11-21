const { describe, it } = require('mocha');
const Page = require('../lib/basePage');
const sleep = require('../utils/sleep');
const expect = require('chai').expect;
const assert = require('chai').assert;

const testCase1 = async () => {
  describe('Add To Cart', async function () {
    this.timeout(50000);
    const page = new Page();

    it('not logged', async () => {
      await page.visit('http://localhost/shop');
      await sleep(2000);

      const btnAddToCart = await page.findByClassNameOnly('addToCart');
      await btnAddToCart.click();
      await sleep(2000);

      const currentUrl = await page.driver.getCurrentUrl();
      if (currentUrl !== 'http://localhost/signin') {
        assert.fail();
      }
    });

    after(async () => {
      await page.quit();
    });
  });
};

const testCase2 = async () => {
  describe('Add To Cart', async function () {
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

      await page.visit('http://localhost/shop');
      await sleep(2000);

      const btnAddToCart = await page.findByClassNameOnly('addToCart');
      await btnAddToCart.click();
      await sleep(2000);

      const toast = await page.findByClassNameOnly('toast-title');
      const mess = await toast.getText();
      expect(mess).to.equal('Đã thêm vào giỏ hàng');
    });

    after(async () => {
      await page.quit();
    });
  });
};
