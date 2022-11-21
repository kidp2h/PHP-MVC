const { describe, it } = require('mocha');
const Page = require('../lib/basePage');
const sleep = require('../utils/sleep');
const expect = require('chai').expect;

const testCase1 = async () => {
  describe('Admin Delete Product', async function () {
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

    it('success', async () => {
      const btnRemove = await page.findByClassNameOnly('button-icon remove');
      await btnRemove.click();
      await sleep(2000);

      const toast = await page.findByClassNameOnly('message-toast');
      const mess = await toast.getText();
      expect(mess).to.equal('Delete product success');

      await sleep(2000);
    });

    after(async () => {
      await page.quit();
    });
  });
};

// testCase1();
