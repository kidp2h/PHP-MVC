const { describe, it } = require('mocha');
const Page = require('../lib/basePage');
const sleep = require('../utils/sleep');
const expect = require('chai').expect;
const assert = require('chai').assert;

const testCase1 = async () => {
  describe('Register', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signup');
    });

    it('empty', async () => {
      const inputFullName = await page.findById('fullname');
      const inputEmail = await page.findById('email');
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const inputConfirmPassword = await page.findById('confirm-password');
      const validation = await page.findByClassName('validate-message');
      const btnSign = await page.findById('btn-signup');

      await inputFullName.sendKeys('');
      await inputEmail.sendKeys('');
      await inputUsername.sendKeys('');
      await inputPassword.sendKeys('');
      await inputConfirmPassword.sendKeys('');
      await btnSign.click();

      const fullNameValidationMess = await validation[0].getText();
      const emailValidationMess = await validation[1].getText();
      const usernameValidationMess = await validation[2].getText();
      const passwordValidationMess = await validation[3].getText();
      const confirmPasswordValidationMess = await validation[4].getText();

      expect(fullNameValidationMess).to.not.be.empty;
      expect(emailValidationMess).to.not.be.empty;
      expect(usernameValidationMess).to.not.be.empty;
      expect(passwordValidationMess).to.not.be.empty;
      expect(confirmPasswordValidationMess).to.not.be.empty;
    });

    after(async () => {
      await page.quit();
    });
  });
};

const testCase2 = async () => {
  describe('Register', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signup');
    });

    it('invalid', async () => {
      const inputFullName = await page.findById('fullname');
      const inputEmail = await page.findById('email');
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const inputConfirmPassword = await page.findById('confirm-password');
      const btnSign = await page.findById('btn-signup');

      await inputFullName.sendKeys('Nguyen Phuc Thinh');
      await inputEmail.sendKeys('phucthinh@gmail.com');
      await inputUsername.sendKeys('admin');
      await inputPassword.sendKeys('admin');
      await inputConfirmPassword.sendKeys('admin');
      await btnSign.click();

      await sleep(2000);

      const toast = await page.findByClassNameOnly('message-toast');
      const mess = await toast.getText();
      expect(mess).to.equal('Username or email is exist');
    });

    after(async () => {
      await page.quit();
    });
  });
};

const testCase3 = async () => {
  describe('Register', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signup');
    });

    it('valid', async () => {
      const inputFullName = await page.findById('fullname');
      const inputEmail = await page.findById('email');
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const inputConfirmPassword = await page.findById('confirm-password');
      const btnSign = await page.findById('btn-signup');

      await inputFullName.clear();
      await inputEmail.clear();
      await inputUsername.clear();
      await inputPassword.clear();
      await inputConfirmPassword.clear();
      await inputFullName.sendKeys('Chau Phu Thinh');
      await inputEmail.sendKeys('phuthinh12344@gmail.com');
      await inputUsername.sendKeys('phuthinh123');
      await inputPassword.sendKeys('123123');
      await inputConfirmPassword.sendKeys('123123');
      await btnSign.click();

      await sleep(5000);
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
