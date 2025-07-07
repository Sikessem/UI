import path from "node:path";
import tailwindcss from "@tailwindcss/postcss";
import postcss from "postcss";
import { describe, expect, it } from "vitest";

const html = String.raw;
const css = String.raw;

function run(
  input = "@import 'tailwindcss'; @config '../tailwind.config.ts';",
  plugin = tailwindcss,
) {
  const { currentTestName } = expect.getState();
  return postcss(plugin()).process(input, {
    from: `${path.resolve(__filename)}?test=${currentTestName}`,
  });
}

describe.concurrent("suite", () => {
  const config = {
    content: [
      {
        raw: html`<div class="text-red bg-red-0 border-red-4"><a href="#" class="button-blue">Click button</a><a href="#" class="link-green">Click link</a></div>`,
      },
    ],
  };

  it("should have red text class", async () => {
    return run().then((result) => {
      expect(result.css).toContain(css`.text-red`);
    });
  });

  it("should have bg-red-0 class", async () => {
    return run().then((result) => {
      expect(result.css).toContain(css`.bg-red-0`);
    });
  });

  it("should have border-red-4 class", async () => {
    return run().then((result) => {
      expect(result.css).toContain(css`.border-red-4`);
    });
  });
});
