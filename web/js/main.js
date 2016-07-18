// Case model
function CaseModel(index) {
    var self = this;
    self.index = index;
}

// App model
function AppViewModel() {
    var self = this;

    this.alert = ko.observable('');
    this.alertVisible = ko.observable(false);
    this.canProcess = ko.observable(false);
    this.cases = ko.observable(0);
    this.testCases = ko.observableArray([]);

    this.createCases = function() {
        self.testCases([]);
        self.alert('');
        self.alertVisible(false);
        
        var index = 0;
        for (var i=0; i<self.cases();i++) {
            index = i+1;
            self.testCases.push(new CaseModel(index));
        }
        if (index > 0 ) {
            self.canProcess(true);
        }
    }

    this.validatesSubmit = function (form) {
        var flag = true;
        $('[id*=case]').each(function () {
            if ( $(this).val() == '') {
                flag = false;
            }
        });

        if (!flag) {
            self.alert('You must add the test cases');
            self.alertVisible(true);
            return false;
        }

        return true;
    }

}

// Activates knockout.js
ko.applyBindings(new AppViewModel());