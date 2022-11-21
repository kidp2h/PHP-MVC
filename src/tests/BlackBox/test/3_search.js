const { By } = require('selenium-webdriver');
const { describe, it } = require('mocha');
const Page = require('../lib/basePage');
const sleep = require('../utils/sleep');
const expect = require('chai').expect;

const testCase1 = async () => {
  describe('Search', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/shop');
    });

    it('found', async () => {
      const filter = await page.findById('ter');
      await filter.click();

      await sleep(2000);

      const inputName = await page.findById('search');
      const formFilter = await page.findById('formfilter');
      await inputName.sendKeys('nitro');
      await formFilter.submit();

      await sleep(2000);

      const products = await page.findById('products');
      const result = await products.findElements(By.className('product'));
      expect(result).to.not.be.empty;
    });

    after(async () => {
      await page.quit();
    });
  });
};

const testCase2 = async () => {
  describe('Search', async function () {
    this.timeout(50000);
    const page = new Page();

    before(async () => {
      await page.visit('http://localhost/shop');
    });

    it('not found', async () => {
      const filter = await page.findById('ter');
      await filter.click();

      await sleep(2000);

      const inputName = await page.findById('search');
      const formFilter = await page.findById('formfilter');
      await inputName.sendKeys('acvdddd');
      await formFilter.submit();

      await sleep(2000);

      await page.findById('empty');
    });

    after(async () => {
      await page.quit();
    });
  });
};
