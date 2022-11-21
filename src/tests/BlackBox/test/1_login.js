const { describe, it } = require('mocha');
const Page = require('../lib/basePage');
const sleep = require('../utils/sleep');
const expect = require('chai').expect;
const assert = require('chai').assert;

const testCase1 = async () => {
  describe('Login', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signin');
    });

    it('empty', async () => {
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const validation = await page.findByClassName('validate-message');
      const btnSign = await page.findById('btn-signin');

      await inputUsername.sendKeys('');
      await inputPassword.sendKeys('');
      await btnSign.click();

      const usernameValidationMess = await validation[0].getText();
      const passwordValidationMess = await validation[1].getText();

      expect(usernameValidationMess).to.not.be.empty;
      expect(passwordValidationMess).to.not.be.empty;
    });

    after(async () => {
      await page.quit();
    });
  });
};

const testCase2 = async () => {
  describe('Login', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signin');
    });

    it('invalid', async () => {
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const btnSign = await page.findById('btn-signin');

      await inputUsername.sendKeys('phuthinhabc');
      await inputPassword.sendKeys('admin');
      await btnSign.click();
      await sleep(2000);

      const toast = await page.findByClassNameOnly('message-toast');
      const mess = await toast.getText();
      expect(mess).to.equal('Username or password is wrong');
    });

    after(async () => {
      await page.quit();
    });
  });
};

const testCase3 = async () => {
  describe('Login', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signin');
    });

    it('valid', async () => {
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const btnSign = await page.findById('btn-signin');

      await inputUsername.clear();
      await inputPassword.clear();
      await inputUsername.sendKeys('admin');
      await inputPassword.sendKeys('admin');
      await btnSign.click();

      await sleep(5000);
      const currentUrl = await page.driver.getCurrentUrl();
      if (currentUrl !== 'http://localhost/') {
        assert.fail();
      }
    });

    after(async () => {
      await page.quit();
    });
  });
};
