import { LocalModule } from './local.module';

describe('LocalModule', () => {
  let localModule: LocalModule;

  beforeEach(() => {
    localModule = new LocalModule();
  });

  it('should create an instance', () => {
    expect(localModule).toBeTruthy();
  });
});
