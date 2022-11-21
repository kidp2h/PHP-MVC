const { describe, it } = require('mocha');
const Page = require('../lib/basePage');
const sleep = require('../utils/sleep');
const expect = require('chai').expect;
const assert = require('chai').assert;

const testCase1 = async () => {
  describe('Admin Create Product', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signin');
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const btnSign = await page.findById('btn-signin');

      await inputUsername.sendKeys('admin');
      await inputPassword.sendKeys('admin');
      await btnSign.click();
      await sleep(2000);

      await page.visit('http://localhost/admin/product');
      await sleep(2000);
    });

    it('name product is exist', async () => {
      const btnCreate = await page.findByClassNameOnly(
        'btn-table-action add-product'
      );
      await btnCreate.click();

      const name = await page.findByClassNameOnly('nameProduct');
      await name.clear();
      await name.sendKeys('Fujifilm Instax Mini 11');

      const btnSave = await page.findByClassNameOnly('button-icon save');
      await btnSave.click();
      await sleep(2000);

      const toast = await page.findByClassNameOnly('message-toast');
      const mess = await toast.getText();
      expect(mess).to.equal('Name product is exist or category not exist !!');

      await sleep(2000);
    });

    after(async () => {
      await page.quit();
    });
  });
};

// testCase1();

const testCase2 = async () => {
  describe('Admin Create Product', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signin');
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const btnSign = await page.findById('btn-signin');

      await inputUsername.sendKeys('admin');
      await inputPassword.sendKeys('admin');
      await btnSign.click();
      await sleep(2000);

      await page.visit('http://localhost/admin/product');
      await sleep(2000);
    });

    it('invalid', async () => {
      const btnCreate = await page.findByClassNameOnly(
        'btn-table-action add-product'
      );
      await btnCreate.click();

      const name = await page.findByClassNameOnly('nameProduct');
      await name.clear();
      const price = await page.findByClassNameOnly('priceProduct');
      await price.clear();

      const btnSave = await page.findByClassNameOnly('button-icon save');
      await btnSave.click();
      await sleep(2000);

      const toast = await page.findByClassNameOnly('message-toast');
      const mess = await toast.getText();
      expect(mess).to.not.equal('Create product success !!');
    });

    after(async () => {
      await page.quit();
    });
  });
};

// testCase2();

const testCase3 = async () => {
  describe('Admin Create Product', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/signin');
      const inputUsername = await page.findById('username');
      const inputPassword = await page.findById('password');
      const btnSign = await page.findById('btn-signin');

      await inputUsername.sendKeys('admin');
      await inputPassword.sendKeys('admin');
      await btnSign.click();
      await sleep(2000);

      await page.visit('http://localhost/admin/product');
      await sleep(2000);
    });

    it('valid', async () => {
      const btnCreate = await page.findByClassNameOnly(
        'btn-table-action add-product'
      );
      await btnCreate.click();

      const name = await page.findByClassNameOnly('nameProduct');
      await name.clear();
      await name.sendKeys('Iphone 14 Pro 1');

      const btnSave = await page.findByClassNameOnly('button-icon save');
      await btnSave.click();
      await sleep(2000);

      const toast = await page.findByClassNameOnly('message-toast');
      const mess = await toast.getText();
      expect(mess).to.equal('Create product success !!');

      await sleep(2000);
    });

    after(async () => {
      await page.quit();
    });
  });
};

// testCase3();
